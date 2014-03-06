zachetka
========

phalcon zachetka

Предположим что по javascript через ajax мы отправляем инфу что пользователь активен и добавляем в коллекцию UsersOnline

Создаем индекс ttl

	db.users_online.ensureIndex( { "createdAt": 1 }, { expireAfterSeconds: 300 } )
=====

	server {
	    listen       80;
	    server_name  zachetka
	    charset      utf-8;
	    root   /var/www/zachetka/app/public;
	    
	    location / {
	        root   /var/www/zachetka/app/public;
	        index  index.php index.html index.htm;
	
	        # if file exists return it right away
	        if (-f $request_filename) {
	            break;
	        }
	
	        # otherwise rewrite it
	        if (!-e $request_filename) {
	            rewrite ^(.+)$ /index.php?_url=$1 last;
	            break;
	        }
	    }
	
	    location ~ \.php {
	        # try_files    $uri =404;
	
	        fastcgi_index  /index.php;
	        fastcgi_pass  unix:///var/run/php5-fpm.sock;
	
	        include fastcgi_params;
	        fastcgi_split_path_info       ^(.+\.php)(/.+)$;
	        fastcgi_param PATH_INFO       $fastcgi_path_info;
	        fastcgi_param PATH_TRANSLATED $document_root$fastcgi_path_info;
	        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
	    }
	
	    location ~* ^/(css|img|js|flv|swf|download)/(.+)$ {
	        root /var/www/zachetka/app/public;
	    }
	}


Настраиваем config/config.php под себя
	
	return new \Phalcon\Config(array(
	    'mongo' => array(
	        'db' => 'zachetka',
	        'connection' => 'mongodb://localhost:27017',
	    ),
		'application' => array(
			'controllersDir' => __DIR__ . '/../../app/controllers/',
			'modelsDir'      => __DIR__ . '/../../app/models/',
			'collectionsDir' => __DIR__ . '/../../app/collections/',
			'viewsDir'       => __DIR__ . '/../../app/views/',
			'pluginsDir'     => __DIR__ . '/../../app/plugins/',
			'libraryDir'     => __DIR__ . '/../../app/library/',
			'baseUri'        => '/app/',
		),
		'models' => array(
			'metadata' => array(
				'adapter' => 'Memory'
			)
		)
	));

Сгененрируем пользователей (опц.)

	php app/cli.php users generate

Запустим в множество потоков авторизацию пользователей

	php app/cli.php users auth

http://zachetka/ - смотрим пользователей

