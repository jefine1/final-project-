<aside style="background-color: black;" class="main-sidebar sidebar-dark-primary elevation-4">
<div class="dropdown">
   <a style="background-color: black;"   href="" class="brand-link">
    
    <h3 class="text-center p-0 m-0"><b> <?php echo $_SESSION['name'] ?>!</b></h3>


</a>
  
</div>
<div class="sidebar pb-4 mb-4">
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item dropdown">
        <a href="./main.php?page=home" class="nav-link ">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li> 
   
    
      <li class="nav-item">
        <a href="main.php?page=home" class="nav-link  ">
          <i class="nav-icon fas fa-boxes"></i>
          <p>
            Parcels
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="main.php?page=new_parcel" class="nav-link  tree-item">
              <i class="fas fa-angle-right nav-icon"></i>
              <p>Add New</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./main.php?page=parcel_list" class="nav-link  nav-sall tree-item">
              <i class="fas fa-angle-right nav-icon"></i>
              <p>List All</p>
            </a>
          </li>
          <?php 
          
    
          ?>
          <li class="nav-item">
            <a href="./main.php?page=parcel_list&s=<?php echo $k ?>" class="nav-link nav-parcel_list_ tree-item">
              
              
            </a>
          
       
        </ul>
      </li>
     
       <li class="nav-item dropdown">
        <a href="./main.php?page=track" class="nav-link ">
          <i class="nav-icon fas fa-search"></i>
          <p>
            Track Parcel
          </p>
        </a>
      </li>  
      <li class="nav-item dropdown">
        <a href="./main.php?page=branch_location" class="nav-link nav-branch">
          <i class="nav-icon fas fa-building"></i>
          <p>
            Oru Branches
          </p>
        </a>
      </li>  
    
    </ul>
  </nav>
</div>
</aside>
<script>
  $(document).ready(function(){
  var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
      var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
  if(s!='')
    page = page+'_'+s;
      if($('.nav-link.nav-'+page).length > 0){
         $('.nav-link.nav-'+page).addClass('active')
          if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
        $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
              $('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
          }
    if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
      $('.nav-link.nav-'+page).parent().addClass('menu-open')
    }

      }
 
  })
</script>