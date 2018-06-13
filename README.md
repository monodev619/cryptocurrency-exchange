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

#### A. Currency Management

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
2. Get Currency Info    
    API: `api.currency.getinfo`  
    URL: `currency/{symbol}`   
    Method: `get`  
    Params: symbol    
    Return: 
    ```javascript
    response.data = {
       [
           "id": Currency ID,
           "name": Name,
           "symbol": SYMBOL,
           "info": Currency Information,
           "logo": Logo url
       ]
    }
    ```
    
#### A. Market Management

1. Get All Market    
    API: `api.market.getall`  
    URL: `markets`  
    Method: `get`  
    Params:     
    Return: 
    ```javascript
    response.data = {
        "BTC_MARKET" : {
            [
               "id": Market ID,
               "name": Market Name,
               "type": Market type(symbol),
               "currency": Market currency name
            ],
            ...
        },
        "ETH_MARKET" : {
            [
                "id": Market ID,
                "name": Market Name,
                "type": Market type(symbol),
                "currency": Market currency name
            ],
            ...
        }
    }
    ```
    
2. Get Market Info    
    API: `api.market.getinfo`  
    URL: `market/{name}`   
    Method: `get`  
    Params: name: market name    
    Return: 
    ```javascript
    response.data = {
       [
           'name' => Market Name,
           'type' => Market Type,
           'currency' => Currency Name,
           'symbol' => Currency Symbol,
           'logo' => Currency Logo,
           'rate' => Rate,
           'change' => Change rate,
           'last_price' => last price,
           'bid' => bid price,
           'ask' => ask price,
           'volume' => Market Volume,
           'high_24h' => Market 24hr high price,
           'low_24h' => Market 24hr low price,
           'minimum' => Market minimum order
       ]
    }
    ```