# symfony-application-using-serializer
Symfony application showing how to use a serializer


## Content
+ [Authorization](https://github.com/grn-it/symfony-application-using-serializer#authorization)
+ [Get List of Messages](https://github.com/grn-it/symfony-application-using-serializer#get-list-of-messages)
+ [Get Message by Id](https://github.com/grn-it/symfony-application-using-serializer#get-message-by-id)
+ [Add Message](https://github.com/grn-it/symfony-application-using-serializer#add-message)
+ [Edit Message](https://github.com/grn-it/symfony-application-using-serializer#edit-message)
+ [Delete Message](https://github.com/grn-it/symfony-application-using-serializer#delete-message)

## Authorization
```php
class ApiLoginController extends AbstractController
{
    #[Route('/api/login', name: 'api_login')]
    public function index(#[CurrentUser] User $user): Response
    {
        return $this->json(['message' => sprintf('Logged In "%s"', $user->getEmail())]);
    }
}
```
[Show full sample code](https://github.com/grn-it/symfony-application-using-serializer/blob/main/src/Controller/ApiLoginController.php)
```bash
curl http://127.0.0.1:8000/api/login -c .cookie-jar -H "Content-Type: application/json" -d '{"username":"walter@gmail.com","password": "123"}' | jq
```
```json
{
  "message": "Logged In \"walter@gmail.com\""
}
```

## Get List of Messages
```php
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
```
[Show full sample code](https://github.com/grn-it/symfony-application-using-serializer/blob/main/src/Controller/MessageController.php)
```bash
curl http://127.0.0.1:8000/api/messages --cookie .cookie-jar
```
```json
[
  {
    "id": 46,
    "from": {
      "id": 55,
      "email": "walter@gmail.com"
    },
    "to": {
      "id": 56,
      "email": "kate@gmail.com"
    },
    "text": "Hi, Kate, how are you settling in?",
    "createdAt": "2022-07-03 12:14:53",
    "updatedAt": "2022-07-03 12:14:53"
  },
  {
    "id": 47,
    "from": {
      "id": 56,
      "email": "kate@gmail.com"
    },
    "to": {
      "id": 55,
      "email": "walter@gmail.com"
    },
    "text": "Just fine thanks. I appreciate you taking the time to help me out with this software. May I ask you what we will be covering today?",
    "createdAt": "2022-07-03 12:15:05",
    "updatedAt": "2022-07-03 12:15:05"
  },
  {
    "id": 48,
    "from": {
      "id": 55,
      "email": "walter@gmail.com"
    },
    "to": {
      "id": 56,
      "email": "kate@gmail.com"
    },
    "text": "Sure. Before I do that, could you tell me if you've worked with this program before? That will help me figure out how to proceed",
    "createdAt": "2022-07-03 12:15:17",
    "updatedAt": "2022-07-03 12:15:17"
  },
  {
    "id": 49,
    "from": {
      "id": 56,
      "email": "kate@gmail.com"
    },
    "to": {
      "id": 55,
      "email": "walter@gmail.com"
    },
    "text": "I've done a little work with it, but not much",
    "createdAt": "2022-07-03 12:15:29",
    "updatedAt": "2022-07-03 12:15:29"
  },
  {
    "id": 50,
    "from": {
      "id": 55,
      "email": "walter@gmail.com"
    },
    "to": {
      "id": 56,
      "email": "kate@gmail.com"
    },
    "text": "Well, it's a good idea to have the manual ready, since it can get a bit hairy. You should start by logging in with your username and password",
    "createdAt": "2022-07-03 12:15:41",
    "updatedAt": "2022-07-03 12:15:41"
  },
  {
    "id": 51,
    "from": {
      "id": 55,
      "email": "walter@gmail.com"
    },
    "to": {
      "id": 57,
      "email": "james@gmail.com"
    },
    "text": "Hi, I'm calling from Nika Corporation. We would like to hold a business lunch at the restaurant",
    "createdAt": "2022-07-03 12:15:53",
    "updatedAt": "2022-07-03 12:15:53"
  },
  {
    "id": 52,
    "from": {
      "id": 57,
      "email": "james@gmail.com"
    },
    "to": {
      "id": 55,
      "email": "walter@gmail.com"
    },
    "text": "Oh, certainly. I'm James, the manager. I can help you with that. How many will there be in your party?",
    "createdAt": "2022-07-03 12:16:05",
    "updatedAt": "2022-07-03 12:16:05"
  },
  {
    "id": 53,
    "from": {
      "id": 55,
      "email": "walter@gmail.com"
    },
    "to": {
      "id": 57,
      "email": "james@gmail.com"
    },
    "text": "There will be about 18 people",
    "createdAt": "2022-07-03 12:16:17",
    "updatedAt": "2022-07-03 12:16:17"
  },
  {
    "id": 54,
    "from": {
      "id": 57,
      "email": "james@gmail.com"
    },
    "to": {
      "id": 55,
      "email": "walter@gmail.com"
    },
    "text": "Okay. For a party that size, we have a separate banquet room in the back",
    "createdAt": "2022-07-03 12:16:29",
    "updatedAt": "2022-07-03 12:16:29"
  },
  {
    "id": 55,
    "from": {
      "id": 55,
      "email": "walter@gmail.com"
    },
    "to": {
      "id": 57,
      "email": "james@gmail.com"
    },
    "text": "Is there an extra charge to reserve the room?",
    "createdAt": "2022-07-03 12:16:41",
    "updatedAt": "2022-07-03 12:16:41"
  },
  {
    "id": 56,
    "from": {
      "id": 57,
      "email": "james@gmail.com"
    },
    "to": {
      "id": 55,
      "email": "walter@gmail.com"
    },
    "text": "No, as long as you can guarantee at least 15 guests, there is no extra charge",
    "createdAt": "2022-07-03 12:16:53",
    "updatedAt": "2022-07-03 12:16:53"
  }
]
```
## Get Message by Id
```php
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
```
[Show full sample code](https://github.com/grn-it/symfony-application-using-serializer/blob/main/src/Controller/MessageController.php)
```bash
curl http://127.0.0.1:8000/api/messages/46 --cookie .cookie-jar | jq
```
```json
{
  "id": 46,
  "from": {
    "id": 55,
    "email": "walter@gmail.com"
  },
  "to": {
    "id": 56,
    "email": "kate@gmail.com"
  },
  "text": "Hi, Kate, how are you settling in?",
  "createdAt": "2022-07-03 12:14:53",
  "updatedAt": "2022-07-03 12:14:53"
}
```
## Add Message
```php
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
```
[Show full sample code](https://github.com/grn-it/symfony-application-using-serializer/blob/main/src/Controller/MessageController.php)
```bash
curl http://127.0.0.1:8000/api/messages --cookie .cookie-jar -d '{"from":{"id":55},"to":{"id":56},"text":"New Message"}' | jq
```
```json
{
  "id": 118,
  "from": {
    "id": 55,
    "email": "walter@gmail.com"
  },
  "to": {
    "id": 56,
    "email": "kate@gmail.com"
  },
  "text": "New Message",
  "createdAt": "2022-07-11 01:01:07",
  "updatedAt": "2022-07-11 01:01:07"
}
```
## Edit Message
```php
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
```
[Show full sample code](https://github.com/grn-it/symfony-application-using-serializer/blob/main/src/Controller/MessageController.php)
```bash
curl -X PUT http://127.0.0.1:8000/api/messages/118 --cookie .cookie-jar -d '{"from":{"id":55},"to":{"id":56},"text":"Edited Message"}' | jq
```
```json
{
  "id": 118,
  "from": {
    "id": 55,
    "email": "walter@gmail.com"
  },
  "to": {
    "id": 56,
    "email": "kate@gmail.com"
  },
  "text": "Edited Message",
  "createdAt": "2022-07-11 01:01:07",
  "updatedAt": "2022-07-11 01:04:05"
}
```
## Delete Message
```php
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
```
[Show full sample code](https://github.com/grn-it/symfony-application-using-serializer/blob/main/src/Controller/MessageController.php)
```bash
curl -X DELETE http://127.0.0.1:8000/api/messages/118 --cookie .cookie-jar | jq
```
```json
{
  "message": "Message has been removed"
}
```
