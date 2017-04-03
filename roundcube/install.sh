## Create database
CREATE DATABASE roundcubemail;
GRANT ALL PRIVILEGES ON roundcubemail.* TO username@localhost IDENTIFIED BY 'password';
FLUSH PRIVILEGES;

## Add to php.ini
extension=php_fileinfo.dll
extension=php_intl.dll
extension=php_ldap.dll

## Next run installer
After uploading the files point your browser to  http://url-to-roundcube/installer/ 

## hmailserver set SSL/TLS in Connection security

## mime types file
http://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types
