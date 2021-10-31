# Codics Back-End Developer Task

This is an example of how you may give instructions on setting up this project locally.
To get a local copy up and running follow these simple example steps.

### Setup



1. Clone the repo :

   ```sh
   git clone https://github.com/ArenGr/codics-elasticsearch-laravel.git
   ```
   
2. Copy content from **.env.example** to **.env** :

    ```sh
    cp .env.example .env
    ```
    
3. Just set up correct **DB** and **Elasticsearch** credentials in **.env** :

    ```sh
    DB_CONNECTION=sqlite
    ELASTICSEARCH_ENABLED=true
    ELASTICSEARCH_HOSTS="localhost:9200"
    ```
    
4. Install **composer** packages :

   ```sh
   composer install
   ```
   
5.  Run migration and seeder : 

    ```
    php artisan migrate
    php artisan db:seed
    ```
   
6. Install **Docker** and **docker-compose** on your computer and run :

    ```
    docker run -d -e "discovery.type=single-node" \
        -e "bootstrap.memory_lock=true" \
        -p 9200:9200 \
        elasticsearch:6.8.1
    ```

7. If everything's ready, run the indexing command :

    ```sh
    php artisan search:reindex
    ```


<!-- USAGE EXAMPLES -->
### Usage


## Filter request example

- request method: POST
- filter endpoints:

```

http://localhost:port/api/filter/

```

![image](https://user-images.githubusercontent.com/47744223/139597518-58f4d254-9795-4348-bc5c-9288d8c5e51e.png)



## Search request example

- request method: POST
- search endpoints:

```
http://localhost:port/api/search/by-name/

http://localhost:port/api/search/by-surname/

http://localhost:port/api/search/by-fullname/
```

![image](https://user-images.githubusercontent.com/47744223/139598115-b1091ea9-d142-483f-9bcc-ac62cb01114c.png)


