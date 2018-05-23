# cryptocurrency-exchange

#### A. User Management

1. Register     
    API: `api.register`  
    Method: `post`  
    Params: `name`, `email`, `password`, `password_confirmation`    
    Return: 
    ```javascript
    response.data = {
       token: 'your auth token'    
    }
    ```
    
2. Login    
    API: `api.login`  
    Method: `post`  
    Params: `email`, `password`    
    Return: 
    ```javascript
    response.data = {
       token: 'your auth token'    
    }
    ```
    
3. Logout    
    API: `api.logout`  
    Method: `post`  
    Params:     
    Return: 
    ```javascript
    response.data = {
       success: true    
    }
    ```


