Algorithms
=======================

Introduction
------------
Это репозиторий для реализации курса по алгоритмам на coursera.org на языке PHP

Installation
------------
### Apache Setup

To setup apache, setup a virtual host to point to the public/ directory of the
project and you should be ready to go! It should look something like below
<VirtualHost *:80>                                                                                                                        
        ServerName sk.todo.mice.dev                                                                                                       
        DocumentRoot /usr/local/www/sk/public                                                                                             
        SetEnv APPLICATION_ENV "development"                                                                                              
        <Directory /usr/local/www/sk/public>                                                                                              
                DirectoryIndex index.php                                                                                                  
                AllowOverride All                                                                                                         
                Order allow,deny                                                                                                          
                Allow from all                                                                                                            
        </Directory>                                                                                                                      
        ErrorLog /var/log/httpd/sk-error.log                                                                                              
        CustomLog /var/log/httpd/sk-access.log common                                                                                     
                                                                                                                                          
                                                                                                                                          
</VirtualHost>         
