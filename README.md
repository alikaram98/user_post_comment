## Post Comment API

Manage nested comments from users who have written for a specific article. <br/>

#### Link API:

-   Register user `localhost:8000/api/register` -> POST method 
    
    ```json
    {
        "name": "admin",
        "email": "admin@gmail.com",
        "password": "admin9898"
    }
    ```
-   Login user `localhost:8000/api/login` -> POST method

    ```json
    {
        "email": "admin@gmail.com",
        "password": "admin9898"
    }
    ```
-   Logout user `localhost:8000/api/logout` -> POST method
-   Get current user `localhost:8000/api/user` -> GET method
-   Post store `localhost:8000/api/post` -> POST method
    ```json
    {
        "title": "post1",
        "text": "message for testing post1"
    }
    ```
-   Post show and get list all comment and nested comment with pagination `localhost:8000/api/post/{id}` -> GET method

    ```
    localhost:8000/api/post/1
    ```
-   Comment store `localhost:8000/api/comment` -> POST method

    ```json
    {
        "parent_id": null, // main comment
        "post_id": 1,
        "comment": "comment1 for post1"
    }
    // or
    {
        "parent_id": 1, // parent comment
        "post_id": 1,
        "comment": "comment2 for comment1"
    }
    ```
-   Comment delete `localhost:8000/api/comment/{id}` -> DELETE method

    ```
    localhost:8000/api/comment/1
    ```
-   Comment update `localhost:8000/api/comment/{id}` -> PUT method
    ```json
    localhost:8000/api/comment/1

    {
        "comment": "new message for comment1"
    }
    ```
