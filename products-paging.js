$(".loader").hide();
/* paging filter */
$(document).ready(function() {
    $(document).on('click','#aPaginate li',function(event){
        event.preventDefault();
          let aTotal = $('#filter_totalPages').val();
          let anum = this.id;
          //console.log(" ID: ====> " +anum);
          if(parseInt(anum) > 1 && anum < parseInt(aTotal)){
              //console.log("anum > 1 and < aTotal == "+aTotal);
              $("#allProductsTable #current_page").val(anum);
              $("#allPagingTable #paging_current_page").val(anum);
              
              let prevPage = parseInt(anum)-1;
              let nextPage = parseInt(anum)+1;
              let ali = '';
              ali += '<ul class="pagination justify-content-end" id="aPaginate">';
                  ali += '<li class="page-item prev-page" id="'+prevPage+'">';
                      ali += '<a class="page-link" aria-label="Previous">';
                          ali += '<span aria-hidden="true">&laquo;</span>';
                  ali += '</a>';
                  ali += '</li>';
                  ali += '<li class="page-item page-active">';
                      ali += '<a class="page-link"><span>'+anum+'</span></a>';
                  ali += '</li>';
                  ali += '<li class="page-item next-page" id="'+nextPage+'">';
                      ali += '<a class="page-link" aria-label="Next">';
                          ali += '<span aria-hidden="true">&raquo;</span>';
                      ali += '</a>';
                  ali += '</li>';
              ali += '</ul>';
              $('#aPaginate').replaceWith(ali);
              let avon = '';
              avon += '<ul class="pagination justify-content-center" id="aPaginateTwo" style="--bs-pagination-bg: none;">';
                  avon += '<li class="page-item page-active">';
                      avon += '<a class="page-link" style="border:0px;">';
                      avon += '<span id="currentPage">'+anum+'</span><span> von </span><span id="total_page">'+aTotal+'</span>';
                  avon += '</a>';
                  avon += '</li>';
              avon += '</ul>';
              $('#aPaginateTwo').replaceWith(avon);
          }else if(parseInt(anum) == parseInt(aTotal) && anum != 1){
              //console.log("anum == aTotal ----> "+anum);
              $("#allProductsTable #current_page").val(anum);
              $("#allPagingTable #paging_current_page").val(anum);
              let prevPage = parseInt(anum)-1;
              let nextPage = parseInt(anum)-1;
              
              let ali2 = '';  
              ali2 += '<ul class="pagination justify-content-end" id="aPaginate">';
                  ali2 += '<li class="page-item prev-page" id="'+prevPage+'">';
                      ali2 += '<a class="page-link" aria-label="Previous">';
                          ali2 += '<span aria-hidden="true">&laquo;</span>';
                      ali2 += '</a>';
                  ali2 += '</li>';
                  ali2 += '<li class="page-item page-active">';
                      ali2 += '<a class="page-link"><span>'+aTotal+'</span></a>';
                  ali2 += '</li>';
                  ali2 += '<li class="page-item disabled">';
                      ali2 += '<a class="page-link" aria-label="Next">';
                          ali2 += '<span aria-hidden="true">&raquo;</span>';
                      ali2 += '</a>';
                  ali2 += '</li>';
              ali2 += '</ul>';
              $('#aPaginate').replaceWith(ali2);
              let avon = '';
              avon += '<ul class="pagination justify-content-center" id="aPaginateTwo" style="--bs-pagination-bg: none;">';
                  avon += '<li class="page-item page-active">';
                      avon += '<a class="page-link" style="border:0px;">';
                      avon += '<span id="currentPage">'+anum+'</span><span> von </span><span id="total_page">'+aTotal+'</span>';
                      avon += '</a>';
                  avon += '</li>';
              avon += '</ul>';
              $('#aPaginateTwo').replaceWith(avon);
          }else if(parseInt(anum) == 1){
              let nextPage = parseInt(anum) +1;
              //console.log("anum <= 1 "+anum);
              $("#allProductsTable #current_page").val(anum);
              $("#allPagingTable #paging_current_page").val(anum);
              let ali3 = '';
              ali3 += '<ul class="pagination justify-content-end" id="aPaginate">';
                  ali3 += '<li class="page-item disabled">';
                      ali3 += '<a class="page-link" aria-label="Previous">';
                          ali3 += '<span aria-hidden="true">&laquo;</span>';
                      ali3 += '</a>';
                  ali3 += '</li>';
                  ali3 += '<li class="page-item page-active">';
                      ali3 += '<a class="page-link"><span>'+anum+'</span></a>';
                  ali3 += '</li>';
                  ali3 += '<li class="page-item next-page" id="'+nextPage+'">';
                      ali3 += '<a class="page-link" aria-label="Next">';
                          ali3 += '<span aria-hidden="true">&raquo;</span>';
                      ali3 += '</a>';
                  ali3 += '</li>';
              ali3 += '</ul>';
              $('#aPaginate').replaceWith(ali3);
              let avon = '';
              avon += '<ul class="pagination justify-content-center" id="aPaginateTwo" style="--bs-pagination-bg: none;">';
                  avon += '<li class="page-item page-active">';
                      avon += '<a class="page-link" style="border:0px;">';
                          avon += '<span id="currentPage">'+anum+'</span><span> von </span><span id="total_page">'+aTotal+'</span>';
                      avon += '</a>';
                  avon += '</li>';
              avon += '</ul>';
              $('#aPaginateTwo').replaceWith(avon);
          } 
          let pagingAjaxUrl = "products-paging.php";
          let pagingData =  $('#allPagingTable').serialize();

          $.ajax({
              async: true, 
              cache: false,
              type: 'POST',
              url: pagingAjaxUrl,
              data: pagingData,
              beforeSend: function() {
                  $(".loader").show();
              },
              success: function(result){
                  $(".loader").hide();
                  $('#productsContent').html(result);
              },
              error: function(result){
                  $(".loader").hide();
                  //console.log(result.statusText);
                  $('#productsContent').html(result.statusText);
              },
              complete: function(){
                  console.log('All paging Filter Request fertig.');
              }
          });
  });
});
      
