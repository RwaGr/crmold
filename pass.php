<?php 


echo substr((sha1(substr((strrev(md5("123456"))),0,20))),3,23);

?>