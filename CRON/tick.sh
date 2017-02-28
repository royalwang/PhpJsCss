 #!/bin/bash
 # php script must be in application folder in my example (www) www-fxstar.rhcloun.com
php ${OPENSHIFT_REPO_DIR}/www/getsymbols.php >> ${OPENSHIFT_PHP_LOG_DIR}/tick.txt
