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

4. Profile
- Set & Update Profile   
    API: `api.updateProfile`  
    Method: `post`  
    Params: `dob`, `country`, `street`, `apt(optional)`, `city`, `state`, `zipcode`, `phone(optional)`    
    Return: 
    ```javascript
    response.data = {
       success: true    
    }
    ```
- Get Profile   
    API: `api.getProfile`  
    Method: `get`  
    Params:     
    Return: 
    ```javascript
    response.data = {
       'dob' : date of birth
       'country' : country
       'street' : street address
       'apt' : apt or unit
       'city' : city
       'state' : state or provice
       'zipcode' : zipcode or postal
       'phone' : phone number    
    }
    ```

#### A. Base Material Management

1. Get All Currency    
    API: `api.currency.getall`  
    URL: `currencies`
    Method: `get`  
    Params:     
    Return: 
    ```javascript
    response.data = {
       [
           "id": Currency ID,
           "name": Name,
           "symbol": SYMBOL,
           "info": Currency Information,
           "logo": Logo url
       ],    
       ...
    }
    ```

2. Get All Market    
    API: `api.market.getall`  
    URL: `markets`
    Method: `get`  
    Params:     
    Return: 
    ```javascript
    response.data = {
       [
           "id": Market ID,
           "name": Market Name,
           "type": Market type(symbol),
           "currency": Market currency
       ],    
       ...
    }
    ```