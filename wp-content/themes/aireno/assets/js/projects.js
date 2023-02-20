"use strict"
jQuery(document).ready(function ($) {
    var firstArea, endArea, totalArea, navigations, navItemTemplate, showCountArea,
        noProjects, projectSearch;

    var totalCount, filterCount, projectsPerPage = 9, page = 1, status = "", totalPage;
    totalCount = $('#user_projects .project-item').length;
    filterCount = totalCount;
    totalPage = Math.ceil(filterCount / projectsPerPage);

    firstArea = $('[data-kt-element="first-project"]');
    endArea = $('[data-kt-element="end-project"]');
    totalArea = $('[data-kt-element="total"]');
    navigations = $('[data-kt-element="navigations"]');
    navItemTemplate = $('[data-kt-element="item-template"]');
    showCountArea = $('[data-kt-element="showCount"]');
    noProjects = $('[data-kt-element="noProjects"]');
    projectSearch = $('[data-kt-project-filter="search"]');

    let showCounts = function () {
        var end = projectsPerPage * page;
        if (end > filterCount) {
            end = filterCount;
        }

        firstArea.html(projectsPerPage * (page - 1) + 1);
        endArea.html(end);
        totalArea.html(filterCount);
    };

    let filterElements = function () {
        $('#kt_scrolltop').trigger('click');
        if (status !== "") {
            filterCount = 0;
            $('#user_projects .project-item').each(function (index, obj) {
                if ($(obj).attr('data-status') === status) {
                    if (filterCount < page * projectsPerPage && filterCount >= (page - 1) * projectsPerPage) {
                        $(obj).removeClass('d-none');
                    } else {
                        $(obj).addClass('d-none');
                    }
                    filterCount++;
                } else {
                    $(obj).addClass('d-none');
                }
            });
        } else {
            $('#user_projects .project-item').each(function (index, obj) {
                if (index < page * projectsPerPage && index >= (page - 1) * projectsPerPage) {
                    $(obj).removeClass('d-none');
                } else {
                    $(obj).addClass('d-none');
                }
            });
            filterCount = totalCount;
        }
        totalPage = Math.ceil(filterCount / projectsPerPage);
    };

    let refineNavigations = function () {
        console.log(page);
        console.log(totalPage);
        if (totalPage === 0) {
            showCountArea.addClass('d-none');
            noProjects.removeClass('d-none');
        } else {
            showCountArea.removeClass('d-none');
            noProjects.addClass('d-none');
            navigations.find('.page-item:not(.previous):not(.next)').remove();
            if (page === 1) {
                navigations.find('.page-item.previous').addClass('disabled');
            } else {
                navigations.find('.page-item.previous').removeClass('disabled');
            }

            if (page === totalPage) {
                navigations.find('.page-item.next').addClass('disabled');
            } else {
                navigations.find('.page-item.next').removeClass('disabled');
            }

            for (var index = 1; index <= totalPage; index++) {
                var nav_item = navItemTemplate.clone().removeClass('d-none').removeAttr('data-kt-element').attr('data-index', index);
                if (index === page) {
                    nav_item.addClass('active');
                }
                nav_item.find('a').html(index);
                navigations.find('.page-item.next').before(nav_item);
            }
        }

    };

    $('body').on('change', '[data-kt-status-filter="true"]', function (ev) {
        status = $(this).val();
        page = 1;
        filterElements();
        showCounts();
        refineNavigations();
    });
    $('body').on('click', '[data-kt-element="navigations"] .page-item:not(.previous):not(.next)', function (ev) {
        page = parseInt($(this).attr('data-index'));
        filterElements();
        showCounts();
        refineNavigations();
    });
    $('body').on('click', '[data-kt-element="navigations"] .page-item.previous:not(.disabled)', function (ev) {
        page --;
        filterElements();
        showCounts();
        refineNavigations();
    });
    $('body').on('click', '[data-kt-element="navigations"] .page-item.next:not(.disabled)', function (ev) {
        page ++;
        filterElements();
        showCounts();
        refineNavigations();
    });

    $('body').on('keyup', '[data-kt-project-filter="search"]', function (ev) {
       var search = $(this).val();
        if (search.length > 0) {
            $('#user_projects .project-item').each(function(){
                if($(this).text().toUpperCase().indexOf(search.toUpperCase()) != -1){
                    $(this).show();
                }
                else {
                    $(this).hide();
                }
            });
        }
        else {
            $('#user_projects .project-item').show();
        }
    });
});
