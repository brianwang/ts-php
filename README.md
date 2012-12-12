ts-php
======
tiny and smart mvc php framework 

My thought of php framework is tiny, smart and powerful. The whole web proces 
can be divided into three process. 
request processing---->controller execute--->output
1. before request coming, we can have some filters for url trim, authentation and etc.
    In my framework, I called them filters.
2. after process request, we get controller and method name.
3. execute the controller method. 
execute the filter after controller execution.
4. using template engine for rendering output


The database I use mongo database, and plan to use an database abstract layer for 
other relationship database

The cache I used the memcacehd for caching, other cache I don't implement it.

The version 0.1 is ready for these functions:
1. code gist demo
2. smarty template engine is ready
3. some filters are ready( cache,authentation)
4. encrypt(aes256) is ready
