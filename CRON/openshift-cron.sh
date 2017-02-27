 #!/bin/bash
 date >> ${OPENSHIFT_PHP_LOG_DIR}/ticktock.log
 curl http://sklep.fxstar.eu >> ${OPENSHIFT_PHP_LOG_DIR}/fxstar.txt
 curl http://www.google.com | grep "<title>" >> ${OPENSHIFT_PHP_LOG_DIR}/fxstar.txt
