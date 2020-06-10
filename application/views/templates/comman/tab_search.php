<?php
$uri = uri_string();
?>
<ul class="nav nav-pills mb-2" id="myClassicTab" style="margin-bottom:2rem" >
<li class="nav-item <?=$uri=='search'?'active':''?>">
  <a class="nav-link  " href="search" >Certificate</a>
</li>
    
<li class="nav-item <?=$uri=='caas'||$uri=='caas/map'?'active':''?>">
  <a class="nav-link  " href="caas" >Find CAAs</a>
</li>
<li class="nav-item <?=$uri=='employers'||$uri=='employers/map'?'active':''?>">
  <a class="nav-link  " href="employers" >Employers</a>
</li>
<li class="nav-item <?=$uri=='programs'||$uri=='programs/map'?'active':''?>">
  <a class="nav-link " href="programs" >Programs</a>
</li>
</ul>        
