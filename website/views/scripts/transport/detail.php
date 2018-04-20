<?php

/* Cover */
echo $this->template("transport/inc-transport-detail.php",array(
    "transport"=>$this->transport,
    "create" => $this->create,
    //"ftIncludedSkus" => $ftIncludedSkus,

));

?>