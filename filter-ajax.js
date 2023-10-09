
/* Filter products and perPage */
$(document).ready(function () {
    $(document).change('#select_product_all option, #select_per_page option', function (evt) {
        evt.preventDefault();
        let category = $('#product_page_filter #category').val();
        console.log(category);
        if (category == 'all') {
            let product_filter = $('#select_category_all').val();
            let perPage = $('#select_per_page').val();

            $("#product_filter").val(product_filter);
            $("#paging_product_filter").val(product_filter);

            $("#per_page").val(perPage);
            $("#paging_per_page").val(perPage);

            $("#paging_current_page").val("1");
            $("#current_page").val("1");

            let filterAjaxUrl = "filter-products.php";
            let filterData = $('#allProductsTable').serialize();
            $.ajax({
                async: true,
                cache: false,
                type: 'POST',
                url: filterAjaxUrl,
                data: filterData,
                beforeSend: function () {
                    $(".loader").show();
                },
                success: function (result) {
                    $(".loader").hide();
                    $('#productsContent').html(result);
                    let totalPages = $('#filter_all_totalPages').val();
                    console.log("Total " + totalPages);
                    $('#total_page').text(totalPages);
                    //$('#p_totalPages').val(totalPages)
                    let currentPage = $('#filter_all_currentPage').val();
                    console.log("Current " + currentPage);
                    if (currentPage == totalPages && totalPages > 1) {
                        let prevPage = parseInt(currentPage) - 1;
                        let ali2 = '';
                        if (prevPage != 0) {
                            ali2 += '<ul class="pagination justify-content-end" id="aPaginate">';
                                ali2 += '<li class="page-item" id="' + prevPage + '" data-type="all">';
                                    ali2 += '<a class="page-link" aria-label="Previous">';
                                        ali2 += '<span aria-hidden="true">&laquo;</span>';
                                    ali2 += '</a>';
                                ali2 += '</li>';
                                ali2 += '<li class="page-item page-active">';
                                    ali2 += '<a class="page-link"><span>' + currentPage + '</span></a>';
                                ali2 += '</li>';
                                ali2 += '<li class="page-item disabled">';
                                    ali2 += '<a class="page-link" aria-label="Next">';
                                        ali2 += '<span aria-hidden="true">&raquo;</span>';
                                    ali2 += '</a>';
                                ali2 += '</li>';
                            ali2 += '</ul>';
                        } else {
                            ali2 += '<ul class="pagination justify-content-end" id="aPaginate">';
                                ali2 += '<li class="page-item disabled">';
                                    ali2 += '<a class="page-link" aria-label="Previous">';
                                        ali2 += '<span aria-hidden="true">&laquo;</span>';
                                    ali2 += '</a>';
                                ali2 += '</li>';
                                ali2 += '<li class="page-item page-active">';
                                    ali2 += '<a class="page-link"><span>' + currentPage + '</span></a>';
                                ali2 += '</li>';
                                ali2 += '<li class="page-item disabled">';
                                    ali2 += '<a class="page-link" aria-label="Next">';
                                        ali2 += '<span aria-hidden="true">&raquo;</span>';
                                    ali2 += '</a>';
                                ali2 += '</li>';
                            ali2 += '</ul>';
                        }
                        $('#aPaginate').replaceWith(ali2);
                        $("#current_page").text("1");
                    } else if (currentPage > 1 && currentPage < totalPages) {
                        let prevPage = parseInt(currentPage) - 1;
                        let nextPage = parseInt(currentPage) + 1;
                        let ali3 = '';
                        ali3 += '<ul class="pagination justify-content-end" id="aPaginate">';
                            ali3 += '<li class="page-item" id="' + prevPage + '" data-type="all">';
                                ali3 += '<a class="page-link" aria-label="Previous">';
                                    ali3 += '<span aria-hidden="true">&laquo;</span>';
                                ali3 += '</a>';
                            ali3 += '</li>';
                            ali3 += '<li class="page-item page-active">';
                                ali3 += '<a class="page-link"><span>' + currentPage + '</span></a>';
                            ali3 += '</li>';
                            ali3 += '<li class="page-item id="' + nextPage + '" data-type="all">';
                                ali3 += '<a class="page-link" aria-label="Next">';
                                    ali3 += '<span aria-hidden="true">&raquo;</span>';
                                ali3 += '</a>';
                            ali3 += '</li>';
                        ali3 += '</ul>';
                        $('#aPaginate').replaceWith(ali3);
                        $("#current_page").text(currentPage);
                    } else if (currentPage == 1 && totalPages > currentPage) {
                        let nextPage = parseInt(currentPage) + 1;
                        let ali1 = '';
                        ali1 += '<ul class="pagination justify-content-end" id="aPaginate">';
                            ali1 += '<li class="page-item disabled">';
                                ali1 += '<a class="page-link" aria-label="Previous">';
                                    ali1 += '<span aria-hidden="true">&laquo;</span>';
                                ali1 += '</a>';
                            ali1 += '</li>';
                            ali1 += '<li class="page-item page-active">';
                                ali1 += '<a class="page-link"><span>' + currentPage + '</span></a>';
                            ali1 += '</li>';
                            ali1 += '<li class="page-item" id="' + nextPage + '" data-type="all">';
                                ali1 += '<a class="page-link" aria-label="Next">';
                                    ali1 += '<span aria-hidden="true">&raquo;</span>';
                                ali1 += '</a>';
                            ali1 += '</li>';
                        ali1 += '</ul>';
                        $('#aPaginate').replaceWith(ali1);
                        $("#current_page").text(currentPage);
                    } else if (currentPage == totalPages == 1) {
                        let ali1 = '';
                        ali1 += '<ul class="pagination justify-content-end" id="aPaginate">';
                            ali1 += '<li class="page-item disabled">';
                                ali1 += '<a class="page-link" aria-label="Previous">';
                                    ali1 += '<span aria-hidden="true">&laquo;</span>';
                                ali1 += '</a>';
                            ali1 += '</li>';
                            ali1 += '<li class="page-item page-active">';
                                ali1 += '<a class="page-link"><span>' + currentPage + '</span></a>';
                            ali1 += '</li>';
                            ali1 += '<li class="page-item disabled">';
                                ali1 += '<a class="page-link" aria-label="Next">';
                                    ali1 += '<span aria-hidden="true">&raquo;</span>';
                                ali1 += '</a>';
                            ali1 += '</li>';
                        ali1 += '</ul>';
                        $('#aPaginate').replaceWith(ali1);
                        $("#current_page").text(currentPage);
                    }
                },
                error: function (result) {
                    $(".loader").hide();
                    //console.log(result.statusText);
                    $('#productsContent').html(results.statusText);
                },
                complete: function () {
                    console.log('product, PerPage Request fertig.');
                }
            });
        }
    });
});
