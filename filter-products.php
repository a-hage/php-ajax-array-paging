
function allProductsFilter($product_filter, $products, $per_page, $current_page, $kunde){
    if($product_filter == 'all'){
        $total = count($products);
        //echo $total ."  Total " ;
        $pages = ceil($total/$per_page);
        //echo $pages . " Pages ";
        if($current_page > $pages){
            $current_page = 1;
        }

        $offset = ($current_page*$per_page) - $per_page;
        //print_r($products);
        $products = array_slice($products, $offset, $per_page);
        //echo "total Pages :".$pages." ----> Offset: ".$offset." ------> Rest: ".($total-$offset)."";
        
        //echo "Total ".$total ." ---> per Page ".$per_page. " ---> PAGES  ALL ". $pages;
        $output = '';
         $output .= '<form action="filter-products.php" id="allProductsTable" method="POST">';
           $output .= '<input type="hidden" name="function_name" id="function_name" value="allProductsFilter" />';
           $output .= '<input type="hidden" name="products_filter" id="products_filter" value="<?php echo $products_filter;?>" /> ';
           $output .= '<input type="hidden" name="products" id="products" value="'.htmlspecialchars(serialize($products)).'" />';
           $output .= '<input type="hidden" name="per_page" id="per_page" value="<?php echo $per_page;?>" />';
           $output .= '<input type="hidden" name="current_page" id="current_page" value="<?php echo $current_page;?>" />';
           $output .= '<input type="hidden" name="kunde" id="kunde" value="<?php echo $kunde;?>" />';
         $output .= '</form>';
	 $output .= '<form action="products-paging.php" id="allPagingTable" method="POST">';
           $output .= '<input type="hidden" name="paging_function_name" id="paging_function_name" value="getAllProducts" />';
           $output .= '<input type="hidden" name="paging_products_filter" id="paging_products_filter" value="<?php echo $products_filter;?>" /> ';
           $output .= '<input type="hidden" name="paging_products" id="paging_products" value="'.htmlspecialchars(serialize($products)).'" />';
           $output .= '<input type="hidden" name="paging_per_page" id="paging_per_page" value="<?php echo $per_page;?>" />';
           $output .= '<input type="hidden" name="paging_current_page" id="paging_current_page" value="<?php echo $current_page;?>" />';
           $output .= '<input type="hidden" name="paging_kunde" id="paging_kunde" value="<?php echo $kunde;?>" />';
         $output .= '</form>';
        $configPage = getConfig_Page($kunde);
        $product_Column = $configPage->products;

        $table ='<table class="table table-striped">';
            $table .= '<thead>';
                $table .= '<tr class="text-start">';
                  $th = '';
                    for($i=0;$i<count($product_Column);$i++){
                      $th .= '<th scope="col">'.$product_Column[$i].'</th>';
                  }
                  $table .= $th;
                $table .= '</tr>';
              $table .= '</thead>';
              $table .= '<tbody>';
             $tr = '';         
            for($i=0;$i<count($products);$i++){
              $tr .= '<tr class="text-start ml-2">';
              $td = '';
              for($k=0;$k<count($product_Column);$k++){
                $column = $product_Column[$k];
                $value = isset($products[$i][$column]) ? $products[$i][$column] : '---';
                $td .= '<td>'.$value.'</td>';
              }
              $tr .= $td;
            $tr .= '</tr>';
          }
          $table .= $tr;       
        $table .= '</tbody>'; 
        $table .= '</table>';
      $output .= $table;
        
    }else{
        $filterProducts = array();
        for($k=0;$k<count($products);$k++){
            if($products[$k]->category == $product_filter){
                $products_filter= getProductsByFilter($kunde, $products[$k]->category);
                $productsValue = $products_filter->value;
                $maxP = count($productsValue);
                for($i=0;$i<$maxP;$i++){
                    if($productsValue[$i]->category != ''){
                        array_push($filterProducts, $productsValue[$i]); 
                    }
                }
            }
        }
        $total = count($filterProducts);
        $pages = ceil($total/$per_page);
        if($current_page > $pages){
            $current_page = 1;
        }
        $offset = ($current_page*$per_page) - $per_page;
        $filterProducts = array_slice($filterProducts, $offset, $per_page);
        // echo "Total ".$total ." --->  per Page ".$per_page. " ---> PAGES OF NOT ALL ". $pages;
	
	$configPage = getConfig_Page($kunde);
        $product_Column = $configPage->products;
        $output = '';
         $output .= '<form action="filter-products.php" id="allProductsTable" method="POST">';
           $output .= '<input type="hidden" name="function_name" id="function_name" value="allProductsFilter" />';
           $output .= '<input type="hidden" name="products_filter" id="products_filter" value="<?php echo $products_filter;?>" /> ';
           $output .= '<input type="hidden" name="products" id="products" value="'.htmlspecialchars(serialize($products)).'" />';
           $output .= '<input type="hidden" name="per_page" id="per_page" value="<?php echo $per_page;?>" />';
           $output .= '<input type="hidden" name="current_page" id="current_page" value="<?php echo $current_page;?>" />';
           $output .= '<input type="hidden" name="kunde" id="kunde" value="<?php echo $kunde;?>" />';
         $output .= '</form>';
	       $output .= '<form action="products-paging.php" id="allPagingTable" method="POST">';
           $output .= '<input type="hidden" name="paging_function_name" id="paging_function_name" value="getAllProducts" />';
           $output .= '<input type="hidden" name="paging_products_filter" id="paging_products_filter" value="<?php echo $products_filter;?>" /> ';
           $output .= '<input type="hidden" name="paging_products" id="paging_products" value="'.htmlspecialchars(serialize($products)).'" />';
           $output .= '<input type="hidden" name="paging_per_page" id="paging_per_page" value="<?php echo $per_page;?>" />';
           $output .= '<input type="hidden" name="paging_current_page" id="paging_current_page" value="<?php echo $current_page;?>" />';
           $output .= '<input type="hidden" name="paging_kunde" id="paging_kunde" value="<?php echo $kunde;?>" />';
         $output .= '</form>';
        
        $table ='<table class="table table-striped">';
            $table .= '<thead>';
                $table .= '<tr class="text-start">';
                $th = '';
                for($i=0;$i<count($product_Column);$i++){
                  $th .= '<th scope="col">'.$product_Column[$i].'</th>';
                }
                $table .= $th;
                $table .= '</tr>';
            $table .= '</thead>';
            $table .= '<tbody>';
            $tr = '';
            for($i=0;$i<count($filterProducts);$i++){
              $tr .= '<tr class="text-start ml-2">';
              $td = '';
              for($k=0;$k<count($product_Column);$k++){
                $column = $product_Column[$k];
                //$value = $filterProducts[$i][$column];
                $value = isset($filterProducts[$i][$column]) ? $filterProducts[$i][$column] : '---';
                $td .= '<td>'.$value.'</td>';
              }
              $tr .= $td;
            $tr .= '</tr>';
          }
            $table .= $tr;
          $table .= '</tbody>'; 
        $table .= '</table>';
    }
    $output .= $table;
    return $output;
}

              
/* Aufruf der Funktionen */
if($_POST['function_name'] == 'allProductsFilter'){
    include('products-module.php');
    $products_filter = $_POST['products_filter'];
    $products = unserialize($_POST['products']);
    $per_page = $_POST['per_page'];
    $current_page = $_POST['currentPage'];
    $kunde = $_POST['kunde'];
    echo allProductsFilter($product_filter, $products, $per_page, $current_page, $kunde);
    exit(0);
}
?>
