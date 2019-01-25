$(function () {
    var searchTimeout = 0;
    $('.select2-multiple').select2({
        placeholder: ajax_object.trans.categories
    });

    $('.select2-single').select2({});

    function submitSearchForm(eventName = '', cb = null) {
        var data = $('#search_form').serializeArray();
        if (eventName !== 'loadMore') {
            toggleLoading();
        }
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'get',
            data: data,
            dataType: 'json',
            success: function (response) {
                if (eventName === 'loadMore') {
                    $('#results_append').append(response.html);
                } else {
                    $('#results_append').html(response.html);
                    toggleLoading();
                }
                if (cb) {
                    cb(response);
                }
            }
        });
    }

    function toggleLoading() {
        $('#loading').toggle();
        $('#results').toggle();

    }

    function resetFields() {
        $('#offset_input').val(0);
        $('#see_more').show();
        $('#no_result').hide();
        $('#result').hide();
    }

    function noResult() {
        $('#result').hide();
        $('#see_more').hide();
        $('#no_result').show();
    }

    if ($('#search_form').length) {
        $('.search-field').each(function (i, el) {
            var eventName;
            if ($(el).prop('type') === 'text') {
                eventName = 'keyup';
            } else {
                eventName = 'change';
            }
            $(el).on(eventName, function () {
                if (searchTimeout !== 0) {
                    clearTimeout(searchTimeout);
                    searchTimeout = 0;
                }
                searchTimeout = setTimeout(function () {
                    resetFields();
                    submitSearchForm(eventName, function (res) {
                        if (res.count == 0) {
                            noResult();
                        }
                    });
                }, 1000);
            });
        });

        $('#see_more').on('click', function (event) {
            var $this = $(this);
            $this.attr('disabled', true);
            event.preventDefault();
            var btn = $('#offset_input');
            var oldOffset = parseInt(btn.val());
            btn.val(oldOffset + 1);
            submitSearchForm('loadMore', function (res) {
                if (res.count == 0) {
                    $this.hide();
                }
                $this.attr('disabled', false);
            });
        });
        submitSearchForm('', function (res) {
            if (res.count == 0) {
                noResult();
            }
        });
    }

    $('.language-change').on('change', function (e) {
        var selected = $(this).children("option:selected");
        if (selected.attr('data-local') !== ajax_object.local) {
            window.location = selected.val();
        }
    });


    $('.toggle-mobile-menu').on('click', function (event) {
        event.preventDefault();
        var mobile = $('#mobile-menu');

        mobile.slideToggle();
    });
    $('#map-locator').on('click', function (e) {
        e.preventDefault();
        initMap({
            lat: parseFloat($(this).attr('data-lat')),
            lng: parseFloat($(this).attr('data-lng')),
        });
        $('#map_container').slideToggle();
    });

    function initMap(location) {
        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 15, center: location});
        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({position: location, map: map});
        // console.log(marker);
    }
});