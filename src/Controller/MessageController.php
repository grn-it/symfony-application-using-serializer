<?php

namespace App\Controller;

use App\Entity\Message;
use App\Service\Message\MessageEditor;
use App\Service\Message\MessagePersister;
use App\Service\Message\MessageRemover;
use App\Service\Message\MessageValidationException;
use App\Service\Message\MessageProvider;
use App\Service\Serializer\Context\SerializerContextBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/')]
class MessageController extends AbstractController
{
    public function __construct(
        private readonly MessageProvider $messageProvider,
        private readonly SerializerInterface $serializer,
        private readonly SerializerContextBuilder $serializerContextBuilder
    ) {}

    #[Route('messages', name: 'message_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $json = $this->serializer->serialize(
            $this->messageProvider->getAll(),
            'json',
            context: $this->serializerContextBuilder->getContextForRead()
        );
        
        return new JsonResponse($json, json: true);
    }
    
    #[Route('messages/{id}', name: 'message_item', methods: ['GET'])]
    public function item(int $id): JsonResponse
    {
        $message = $this->messageProvider->getOne($id);
        if (is_null($message)) {
            return new JsonResponse(['message' => sprintf('Message with id "%d" not found', $id)]);
        }

        $json = $this->serializer->serialize(
            $message,
            'json',
            context: $this->serializerContextBuilder->getContextForRead()
        );

        return new JsonResponse($json, json: true);
    }
    
    #[Route('messages', name: 'message_add', methods: ['POST'])]
    public function add(Request $request, MessagePersister $messagePersister): JsonResponse
    {
        try {
            $message = $this->serializer->deserialize(
                $request->getContent(),
                Message::class,
                'json',
                context: $this->serializerContextBuilder->getContextForWrite()
            );
            
            $message = $messagePersister->persist($message);
        } catch (MessageValidationException $exception) {
            return new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $exception) {
            return new JsonResponse(['message' => 'Message has not been added'], Response::HTTP_BAD_REQUEST);
        }
            
        $json = $this->serializer->serialize(
            $message,
            'json',
            context: $this->serializerContextBuilder->getContextForRead()
        );
        
        return new JsonResponse($json, json: true);
    }
    
    #[Route('messages/{id}', name: 'message_edit', methods: ['PUT'])]
    public function edit(int $id, Request $request, MessageEditor $messageEditor): JsonResponse
    {
        try {
            $message = $this->messageProvider->getOne($id);
            if (is_null($message)) {
                return new JsonResponse(['message' => sprintf('Message with id "%d" not found', $id)]);
            }

            $editedMessage = $this->serializer->deserialize(
                $request->getContent(),
                Message::class,
                'json',
                context: $this->serializerContextBuilder->getContextForWrite()
            );

            $message = $messageEditor->edit($message, $editedMessage);
        } catch (MessageValidationException $exception) {
            return new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $exception) {
            return new JsonResponse(['message' => 'Message has not been edited'], Response::HTTP_BAD_REQUEST);
        }

        $json = $this->serializer->serialize(
            $message,
            'json',
            context: $this->serializerContextBuilder->getContextForRead()
        );

        return new JsonResponse($json, json: true);
    }
    
    #[Route('messages/{id}', name: 'message_remove', methods: ['DELETE'])]
    public function remove(int $id, MessageRemover $messageRemover): JsonResponse
    {
        try {
            $message = $this->messageProvider->getOne($id);
            if (is_null($message)) {
                return new JsonResponse(['message' => sprintf('Message with id "%d" not found', $id)]);
            }

            $messageRemover->remove($message);
        } catch (MessageValidationException $exception) {
            return new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $exception) {
            return new JsonResponse(['message' => 'Message has not been removed'], Response::HTTP_BAD_REQUEST);
        }
        
        return new JsonResponse(['message' => 'Message has been removed']);
    }
}
