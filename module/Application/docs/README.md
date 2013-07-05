# Apache VHost

	<VirtualHost *:80>
	    ServerName phpcounter.dev
	    DocumentRoot /vagrant/phpcounter/public
	    SetEnv APPLICATION_ENV "development"
	    SetEnv PROJECT_ROOT "/vagrant/phpcounter"
	    <Directory /vagrant/phpcounter/public>
	        DirectoryIndex index.php
	        AllowOverride All
	        Order allow,deny
	        Allow from all
	    </Directory>
	</VirtualHost>	