$().ready(function() {
    $("input[name=coCity], input[name=coCp]").autocomplete({
        minLength: 1,
        scrollHeight: 220,
        source: function(request, response) {
            $.ajax({
                url: 'index.php?page=city/getCities',
                type: "get",
                dataType: 'json',
                data: {part: request.term, country: $("input[name=coCountry]").val()},
                async: true,
                cache: true,
                success: function(data) {
                    if (data !== null) {
                        response($.map(data, function(item) {
                            return {
                                label: item.zip + " " + item.city,
                                value: function() {
                                    if ($(this).attr('id') == 'coCp') {
                                        $('#coCity').val(item.city);
                                        return item.zip;
                                    } else {
                                        $('#coCp').val(item.zip);
                                        return item.city;
                                    }

                                }
                            }
                            ;
                        }));
                    }
                }
            });
        }
    });

    $("input[name=roCity], input[name=roCp]").autocomplete({
        minLength: 1,
        scrollHeight: 220,
        source: function(request, response) {
            $.ajax({
                url: 'index.php?page=city/getCities',
                type: "get",
                dataType: 'json',
                data: {part: request.term, country: $("input[name=roCountry]").val()},
                async: true,
                cache: true,
                success: function(data) {
                    if (data !== null) {
                        response($.map(data, function(item) {
                            return {
                                label: item.zip + " " + item.city,
                                value: function() {
                                    if ($(this).attr('id') == 'roCp') {
                                        $('#roCity').val(item.city);
                                        return item.zip;
                                    } else {
                                        $('#roCp').val(item.zip);
                                        return item.city;
                                    }

                                }
                            }
                            ;
                        }));
                    }
                }
            });
        }
    });
});

