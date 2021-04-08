(function ($) {
    $(document).on('click', '.auth-button', function () {
        event.preventDefault();
        var phonenumber = $('input[name="phonenumber"]').val();
        var pass = $('input[name="pass"]').val();

        if (phonenumber.length == 0) {
            $('.error-message-auth.num').html("Данное поле должно быть заполнено!");
            $('.error-message-auth.num').fadeIn(300);
            $('.error-message-auth.num').fadeOut(1000);
            return;
        } else if (pass.length == 0) {
            $('.error-message-auth.pass').html("Данное поле должно быть заполнено!");
            $('.error-message-auth.pass').fadeIn(300);
            $('.error-message-auth.pass').fadeOut(1000);
            return;
        }
        $.ajax({
            url: 'modules/account/auth_bd.php',
            method: 'post',
            dataType: 'html',
            data: ({
                phonenumber: phonenumber,
                pass: pass
            }),
            success: function (data) {
                if (data == "Неверный номер телефона или пароль") {
                    $('#error-message-auths').html("Неверный номер телефона или пароль");
                    $('#error-message-auths').fadeIn(300);
                    $('#error-message-auths').fadeOut(1000);
                } else {
                    location.reload();
                }
            }
        });
    })
    $(document).on('click', '.reg-button', function () {
        event.preventDefault();
        var UsName = $('input[name="UsName"]').val();
        var UsLastName = $('input[name="UsLastName"]').val();
        var UsPhoneNumber = $('input[name="UsPhoneNumber"]').val();
        var UsPasswordOne = $('input[name="UsPasswordOne"]').val();
        var UsPasswordTwo = $('input[name="UsPasswordTwo"]').val();
        if (UsLastName.length < 3) {
            $('.error-message-reg.lastname').html("Поле ФАМИЛИЯ не может содержать менее 3-ех символов!");
            $('.error-message-reg.lastname').fadeIn(300);
            $('.error-message-reg.lastname').fadeOut(1000);
            return;
        }
        if (UsLastName.length > 12) {
            $('.error-message-reg.lastname').html("Поле ФАМИЛИЯ не может содержать более 12-ти символов!");
            $('.error-message-reg.lastname').fadeIn(300);
            $('.error-message-reg.lastname').fadeOut(1000);
            return;
        }
        if (UsName.length < 3) {
            $('.error-message-reg.name').html("Поле ИМЯ не может содержать менее 3-ех символов!");
            $('.error-message-reg.name').fadeIn(300);
            $('.error-message-reg.name').fadeOut(1000);
            return;
        }
        if (UsName.length > 12) {
            $('.error-message-reg.name').html("Поле ИМЯ не может содержать более 12-ти символов!");
            $('.error-message-reg.name').fadeIn(300);
            $('.error-message-reg.name').fadeOut(1000);
            return;
        }
        if (UsPhoneNumber.length != 16) {
            $('.error-message-reg.number').html("Неверный формат номера телефона!");
            $('.error-message-reg.number').fadeIn(300);
            $('.error-message-reg.number').fadeOut(1000);
            return;
        }
        if (UsPasswordOne != UsPasswordTwo) {
            $('#error-message-reg').html("Введенные пароли не совпадают!");
            $('#error-message-reg').fadeIn(300);
            $('#error-message-reg').fadeOut(1000);
            return;
        }
        if (UsPasswordTwo.length < 4) {
            $('.error-message-reg.passtwo').html("Поле ПАРОЛЬ не может содержать менее 4-ех символов!");
            $('.error-message-reg.passtwo').fadeIn(300);
            $('.error-message-reg.passtwo').fadeOut(1000);
            return;
        }
        $.ajax({
            url: 'modules/account/reg_bd.php',
            method: 'post',
            dataType: 'html',
            data: ({
                UsPhoneNumber: UsPhoneNumber,
                UsLastName: UsLastName,
                UsName: UsName,
                UsPasswordOne: UsPasswordOne,
                UsPasswordTwo: UsPasswordTwo,
                UsSex: $('.user-sex').val()
            }),
            success: function (data) {
                if (data == "Данный номер телефона уже зарегистрирован!") {
                    $('.error-message-reg.number').html("Данный номер телефона уже зарегистрирован!");
                    $('.error-message-reg.number').fadeIn(300);
                    $('.error-message-reg.number').fadeOut(1000);
                } else {
                    $('#error-message-reg h4').html("Аккаунт успешно зарегистрирован!");
                    $('#error-message-reg').fadeIn(300);
                    $('#error-message-reg').fadeOut(1000);
                    $('.popup-bg-reg').fadeOut(1000);
                    $('html').removeClass('no-scroll');
                }
            }
        });
    })
    $(document).on('click', '.categories li a', function () {
        event.preventDefault();
        var link_url = $(this).attr('href');
        $.get(
            'modules/user-content-modules/catalog-content.php', {
                cat_id: link_url,
            },
            function onAjaxSuccess(data) {
                document.getElementById('page-content').innerHTML = data;
            })
    })
    $(document).on('click', '.category-breadcrumb', function () {
        event.preventDefault();
        var link_url = $(this).attr('href');
        $.get(
            'modules/user-content-modules/catalog-content.php', {
                cat_id: link_url,
            },
            function onAjaxSuccess(data) {
                document.getElementById('page-content').innerHTML = data;

            })
    })

    $(document).on('click', '.book-breadcrumb', function () {
        event.preventDefault();
        var page = $('.pageinfo').attr('href');

        $.get(
            'modules/user-content-modules/content-two.php', {
                page: page,
            },
            function onAjaxSuccess(data) {
                document.getElementById('page-content').innerHTML = data;
            })
    })
    $(document).on('click', '.publish li a', function () {
        event.preventDefault();
        var link_url = $(this).attr('href');
        $.get(
            'modules/user-content-modules/publish-content.php', {
                pub_id: link_url,
            },
            function onAjaxSuccess(data) {
                document.getElementById('page-content').innerHTML = data;
            })
    })
    $(document).on('click', '.go-to-basket', function () {
        event.preventDefault();
        var link_url = $(this).attr('href');
        $.get(
            'str/user-content-str/cart.php', {
                pub_id: link_url,
            },
            function onAjaxSuccess(data) {
                document.getElementById('page-content').innerHTML = data;
                $('.offcanvas-close').click();
            })
    })
    $(document).on('click', '.reserve-order', function () {
        event.preventDefault();
        var link_url = $(this).attr('href');
        $.get(
            'modules/cart-modules/reserve-cart.php', {
            },
            function onAjaxSuccess(data) {
                $.get(
                    'str/user-content-str/cart.php', {
                    },
                    function onAjaxSuccess(data) {
                        document.getElementById('page-content').innerHTML = data;
                        $('.offcanvas-close').click();
                    })
            })
    })
    $(document).on('click', '.cart-order', function () {
        event.preventDefault();
        var link_url = $(this).attr('href');
        $.get(
            'modules/cart-modules/cart-form.php', {
            },
            function onAjaxSuccess(data) {
                $.get(
                    'str/user-content-str/cart.php', {
                    },
                    function onAjaxSuccess(data) {
                        document.getElementById('page-content').innerHTML = data;
                    }
                )
            })
    })
    $(document).on('click', '.category-button', function () {
        event.preventDefault();
        var categoryname = $('input[name="categoryname"]').val();
        if (categoryname == "") {
            $('.error-message.cat').html("Данное поле должно быть заполнено!");
            $('.error-message.cat').fadeIn(300);
            $('.error-message.cat').fadeOut(1800);
        } else {
            $.ajax({
                url: 'modules/admin-content-modules/category-addiction.php',
                method: 'post',
                dataType: 'html',
                data: ({
                    categoryname: categoryname
                }),
                success: function (data) {
                    if (data == "Данная категория уже существует!") {
                        $('.error-message.cat').html("Данная категория уже существует!");
                        $('.error-message.cat').css('color', 'gray');
                        $('.error-message.cat').fadeIn(300);
                        $('.error-message.cat').fadeOut(1800);
                    } else {
                        $('.error-message.cat').html("Категория успешно добавлена");
                        $('.error-message.cat').css('color', 'rgba(255, 135, 4, 1)');
                        $('.error-message.cat').fadeIn(300);
                        $('.error-message.cat').fadeOut(1800);
                    }
                }
            })
        }
    })
    $(document).on('click', '.publish-button', function () {
        event.preventDefault();
        var publishname = $('input[name="publishname"]').val();
        if (publishname == "") {
            $('.error-message.cat').html("Данное поле должно быть заполнено!");
            $('.error-message.cat').fadeIn(300);
            $('.error-message.cat').fadeOut(1800);
        } else {
            $.ajax({
                url: 'modules/admin-content-modules/publish-addiction.php',
                method: 'post',
                dataType: 'html',
                data: ({
                    publishname: publishname
                }),
                success: function (data) {
                    if (data == "Данное издательство уже существует!") {
                        $('.error-message.pub').html("Данное издательство уже существует!");
                        $('.error-message.pub').css('color', 'gray');
                        $('.error-message.pub').fadeIn(300);
                        $('.error-message.pub').fadeOut(1800);
                    } else {
                        $('.error-message.pub').html("Издательство успешно добавлена");
                        $('.error-message.pub').css('color', 'rgba(255, 135, 4, 1)');
                        $('.error-message.pub').fadeIn(300);
                        $('.error-message.pub').fadeOut(1800);
                       
                    }
                }
            })
        }
    })
    /*Profile*/
    $(document).on('click', '.m-l-10.top-up', function () {
        event.preventDefault();
        alert("В настоящее время пополнение счета недоступно!");
        return;
    })
    $(document).on('click', '.numbers', function () {
        $(".numbers").replaceWith("<a href='#' class='m-l-10 number'>OK</a></td>");
        $(".t-number").append("<td class='u_number'><input type='text' name='number-rechange' placeholder='Введите новый номер...' id='inputPhoneNumber-profile' class='form-control' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-sm'></td>");
        $("#inputPhoneNumber-profile").mask("+7(999) 999-9999");
    });
    $(document).on('click', '.m-l-10.number', function () {
        event.preventDefault();
        var number_rechange = $('input[name="number-rechange"]').val();
        if (number_rechange.length == 0) {
            $('.error-message-profile.num').html("Данное поле должно быть заполнено!");
            $('.error-message-profile.num').fadeIn(300)
            $('.error-message-profile.num').fadeOut(1000);
            return;
        }
        $.ajax({
            url: 'modules/account/data/number-rechange.php',
            method: 'post',
            dataType: 'html',
            cache: false,
            data: ({
                number_rechange: number_rechange
            }),
            success: function (data) {
                if (data == "Данный номер телефона уже зарегистрирован!") {
                    $('.error-message-profile.num').html("Данный номер телефона уже зарегистрирован!");
                    $('.error-message-profile.num').fadeIn(300);
                    $('.error-message-profile.num').fadeOut(1000);
                    return;
                } else if (data == "Номер телефона успешно изменен!") {
                    $('.error-message-profile.num').html("Номер телефона успешно изменен!");
                    $('.error-message-profile.num').fadeIn(300);
                    $('.error-message-profile.num').fadeOut(1000);
                    $('.s-number').html(number_rechange);
                    $(".u_number").remove();
                    $(".number").replaceWith("<a href='#' class='m-l-10 numbers'>Изменить</a></td>");
                    return;
                }
            }
        })
    })
    $(document).on('click', '.emails', function () {
        $(".emails").replaceWith("<a href='#' class='m-l-10 email'>OK</a></td>");
        $(".t-email").append("<td class='u_email'><input type='text' name='email-rechange' placeholder='Введите новый E-Mail...' class='form-control' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-sm'>");
    });
    $(document).on('click', '.m-l-10.email', function () {
        event.preventDefault();
        var email_rechange = $('input[name="email-rechange"]').val();
        if (email_rechange.length == 0) {
            $('.error-message-profile.em').html("Данное поле должно быть заполнено!");
            $('.error-message-profile.em').fadeIn(300)
            $('.error-message-profile.em').fadeOut(1000);
            return;
        }
        $.ajax({
            url: 'modules/account/data/email-rechange.php',
            method: 'post',
            dataType: 'html',
            cache: false,
            data: ({
                email_rechange: email_rechange
            }),
            success: function (data) {
                if (data == "Данный E-Mail уже зарегистрирован!") {
                    $('.error-message-profile.em').html("Данный E-Mail уже зарегистрирован!");
                    $('.error-message-profile.em').fadeIn(300);
                    $('.error-message-profile.em').fadeOut(1000);
                    return;
                } else if (data == "E-Mail успешно изменен!") {
                    $('.error-message-profile.em').html("E-Mail успешно изменен!");
                    $('.error-message-profile.em').fadeIn(300);
                    $('.error-message-profile.em').fadeOut(1000);
                    $('.s-email').html(email_rechange);
                    $(".u_email").remove();
                    $(".email").replaceWith("<a href='#' class='m-l-10 emails'>Изменить</a></td>");
                    return;
                }
            }
        })
    })

    $(document).on('click', '.dateofbirths', function () {
        $(".dateofbirths").replaceWith("<a href='#' class='m-l-10 dateofbirth'>OK</a></td>");
        $(".t-dateofbirth").append("<td class='u_dateofbirth'><input type='date' name='date-rechange' class='form-control' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-sm'>");
    });
    $(document).on('click', '.m-l-10.dateofbirth', function () {
        event.preventDefault();
        var date_rechange = $('input[name="date-rechange"]').val();
        if (date_rechange.length == 0) {
            $('.error-message-profile.dt').html("Данное поле должно быть заполнено!");
            $('.error-message-profile.dt').fadeIn(300)
            $('.error-message-profile.dt').fadeOut(1000);
            return;
        }
        $.ajax({
            url: 'modules/account/data/dateofbirth-rechange.php',
            method: 'post',
            dataType: 'html',
            cache: false,
            data: ({
                date_rechange: date_rechange
            }),
            success: function (data) {
                if (data == "Дата рождения успешно изменена!") {
                    $('.error-message-profile.dt').html("Дата рождения успешно изменена!");
                    $('.error-message-profile.dt').fadeIn(300);
                    $('.error-message-profile.dt').fadeOut(1000);
                    $('.s-dateofbirth').html(date_rechange);
                    $(".u_dateofbirth").remove();
                    $(".dateofbirth").replaceWith("<a href='#' class='m-l-10 dateofbirths'>Изменить</a></td>");
                    return;
                }
            }
        })
    })
    $(document).on('click', '.link_pass_ones', function () {
        $(".link_pass_ones").replaceWith("<a href='#' class='m-l-10 link_pass_one'>OK</a></td>");
        $(".t-pass_one").append("<td class='u_passone'><input type='password' placeholder='введите пароль...' name='passwordOne-rechange' class='form-control' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-sm'></td>");
        $(".fd-pass").show();
        $(".t-pass_two").show();
        $(".twopass").show();
        $(".t-pass_two").append("<td class='u_passtwo'><input type='password' placeholder='повторите пароль...' name='passwordTwo-rechange' class='form-control' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-sm'></td>");
    });
    $(document).on('click', '.m-l-10.link_pass_one', function () {
        event.preventDefault();
        var passwordOne_rechange = $('input[name="passwordOne-rechange"]').val();
        var password_rechange = $('input[name="passwordTwo-rechange"]').val();
        if (passwordOne_rechange.length == 0) {
            $('.error-message-profile.pass_one').html("Данное поле должно быть заполнено!");
            $('.error-message-profile.pass_one').fadeIn(300)
            $('.error-message-profile.pass_one').fadeOut(1000);
            return;
        } else if (password_rechange.length == 0) {
            $('.error-message-profile.pass_two').html("Данное поле должно быть заполнено!");
            $('.error-message-profile.pass_two').fadeIn(300)
            $('.error-message-profile.pass_two').fadeOut(1000);
            return;
        } else if (passwordOne_rechange != password_rechange) {
            $('.error-message-profile.pass_one').html("Данные поля должны совпадать!");
            $('.error-message-profile.pass_one').fadeIn(300)
            $('.error-message-profile.pass_one').fadeOut(1000);
            $('.error-message-profile.pass_two').html("Данные поля должны совпадать!");
            $('.error-message-profile.pass_two').fadeIn(300)
            $('.error-message-profile.pass_two').fadeOut(1000);
            return;
        }
        $.ajax({
            url: 'modules/account/data/password-rechange.php',
            method: 'post',
            dataType: 'html',
            cache: false,
            data: ({
                password_rechange: password_rechange
            }),
            success: function (data) {
                if (data == "Пароль успешно изменен!") {
                    $('.error-message-profile.pass_one').html("Пароль успешно изменен!");
                    $('.error-message-profile.pass_one').fadeIn(300);
                    $('.error-message-profile.pass_one').fadeOut(1000);
                    $('.s-password').html("**********************************************");
                    $(".u_passone").remove();
                    $(".u_passtwo").remove();
                    $(".twopass").hide();
                    $(".link_pass_one").replaceWith("<a href='#' class='m-l-10 link_pass_ones'>Изменить</a></td>");
                    return;
                }
            }
        })
    })
    $(document).on('click', '.sexs', function () {
        event.preventDefault();
        var sex_rechange_str = $('.s-sex').text();
        var sex_rechange = 0;
        if (sex_rechange_str == "Мужской") {
            sex_rechange = 0;
        } else {
            sex_rechange = 1;
        }
        $.ajax({
            url: 'modules/account/data/sex-rechange.php',
            method: 'post',
            dataType: 'html',
            cache: false,
            data: ({
                sex_rechange: sex_rechange
            }),
            success: function (data) {
                if (data == "Пол успешно изменен!") {
                    $('.error-message-profile.se').html("Пол успешно изменен!");
                    $('.error-message-profile.se').fadeIn(300);
                    $('.error-message-profile.se').fadeOut(1000);
                    if (sex_rechange == 1) {
                        $('.s-sex').html("Мужской");
                    } else {
                        $('.s-sex').html("Женский");
                    }
                    $(".sexs").replaceWith("<a href='#' class='m-l-10 sexs'>Изменить</a></td>");
                    return;
                }
            }
        })

    })
    $(document).on('click', '.book-search', function () {
        event.preventDefault();
        link_url = $(this).attr('href');

        $.get(
            'str/user-content-str/product.php', {
                book_id: link_url,
            },
            function onAjaxSuccess(data) {
                document.getElementById('page-content').innerHTML = data;
                $('#s_result').css('display', 'none');
                $('#searchhh')[0].reset();
            })
    })
    $(document).on('click', '.book_id-info', function () {
        event.preventDefault();
        link_url = $(this).attr('href');

        $.get(
            'str/user-content-str/product.php', {
                book_id: link_url,
            },
            function onAjaxSuccess(data) {
                document.getElementById('page-content').innerHTML = data;
            })
    })
    $(document).on('click', '.book_id-buy', function () {
        event.preventDefault();
        link_url = $(this).attr('href');
        $.get(
            'modules/user-content-modules/basket-popup/basket-popup-addbook.php', {
                book_id: link_url,
            },
            function onAjaxSuccess(data) {
                $.get(
                    'modules/user-content-modules/basket-popup/basket-content-ajax.php',
                    function onAjaxSuccess(data) {
                        $('.minicart-product-list').html(data);
                    })
                    $.get(
                        'modules/user-content-modules/basket-popup/basket-count-ajax.php',
                        function onAjaxSuccess(data) {
                            $('.count-basket').html(data);
                        })
                    if($('.book-free'+link_url).html() !== 'Бесплатно'){
                        $.get(
                            'modules/user-content-modules/basket-popup/basket-popup-price.php',
                            function onAjaxSuccess(data) {
                                $('.price').html(data);
                            })
                    }
            })
    })
    $(document).on('click', '.book_id-buy-productpage', function () {
        event.preventDefault();
        link_url = $(this).attr('href');
        $.get(
            'modules/user-content-modules/basket-popup/basket-popup-addbook.php', {
                book_id: link_url,
            },
            function onAjaxSuccess(data) {
                $.get(
                    'modules/user-content-modules/basket-popup/basket-content-ajax.php',
                    function onAjaxSuccess(data) {
                        $('.minicart-product-list').html(data);
                    })
                    $.get(
                        'modules/user-content-modules/basket-popup/basket-count-ajax.php',
                        function onAjaxSuccess(data) {
                            $('.count-basket').html(data);
                        })
                    if($('.book-free'+link_url).html() !== 'Бесплатно'){
                        $.get(
                            'modules/user-content-modules/basket-popup/basket-popup-price.php',
                            function onAjaxSuccess(data) {
                                $('.price').html(data);
                            })
                    }
                $('.error-message-addiction-book.buy').html("Книга была добавлена в корзину");
                $('.error-message-addiction-book.buy').fadeIn(300);
                $('.error-message-addiction-book.buy').fadeOut(1000);
            return;
            })
    })
    $(document).on('click', '.form-email', function () {
        event.preventDefault();
        $('.post').css('display', 'inline-block');
        if($('.order-pay').val() == 'Баланс на сайте'){
            $.get(
                '../mail.php', {
                },
                function onAjaxSuccess(data) {
                    if(data == 'E-Mail не был введен!'){
                        $('.post').css('display', 'none');

                        $('.error-message-emailprofile').html("Вы не указали E-Mail в профиле!");
                        $('.error-message-emailprofile').fadeIn(300);
                        $('.error-message-emailprofile').fadeOut(1000);
                        return;
                    }else if(data == 'Возраст слишком мал!') {
                        $('.post').css('display', 'none');
    
                        $('.error-message-emailprofile').html("Ваш возраст не подходит для данных книг!");
                        $('.error-message-emailprofile').fadeIn(300);
                        $('.error-message-emailprofile').fadeOut(2400);
                        return;
                    }else if(data =='У Вас недостаточно средств на счете!'){
                        $('.post').css('display', 'none');
    
                        $('.error-message-emailprofile').html("У Вас на счете недостаточно средств!");
                        $('.error-message-emailprofile').fadeIn(300);
                        $('.error-message-emailprofile').fadeOut(2400);
                    }
                    else if(data == 'Книги успешно отправлены!') {
                        $('.post').css('display', 'none');
                        $('.post-end').css('display', 'inline-block');
                        $('.post-end').fadeOut(1000);
    
                        $('.error-message-emailprofile').html("Книга была выслана на почту, которая указана в профиле!");
                        $('.error-message-emailprofile').fadeIn(300);
                        $('.error-message-emailprofile').fadeOut(2400);
    
                        $.get(
                            'modules/user-content-modules/basket-popup/basket-content-ajax.php',
                            function onAjaxSuccess(data) {
                                $('.minicart-product-list').html(data);
                            })
                        $.get(
                            'modules/cart-modules/cart-content-ajax.php',
                            function onAjaxSuccess(data) {
                                $('.testttt').html(data);
                            })
                        $.get(
                            'modules/cart-modules/cart-price.php',
                             function onAjaxSuccess(data) {
                                $('.price-result').html(data);
                            })
                        $.get(
                            'modules/user-content-modules/basket-popup/basket-popup-price.php',
                            function onAjaxSuccess(data) {
                                if (data <= 0) {
                                    $('.price').html("0");
                                } else {
                                    $('.price').html(data);
                                }
                            })
                        $.get(
                            'modules/user-content-modules/basket-popup/basket-count-ajax.php',
                            function onAjaxSuccess(data) {
                                $('.count-basket').html(data);
                            })
                        return;
                    }else if(data == 'Одна или несколько книг не осталось на складе'){
                        $('.post').css('display', 'none');
    
                        $('.error-message-emailprofile').html("На складе не хватает одной или несколько книжек.");
                        $('.error-message-emailprofile').fadeIn(300);
                        $('.error-message-emailprofile').fadeOut(2400);
                    }
                })
        }else if($('.order-pay').val() == 'Банковская карта'){
            $.get(
                'modules/payment-bank.php', {
                },
                function onAjaxSuccess(data) {
                    document.getElementById('page-content').innerHTML = data;
                })
        }else{
            $.get(
                '../mail.php', {
                },
                function onAjaxSuccess(data) {
                    if(data == 'E-Mail не был введен!'){
                        $('.post').css('display', 'none');

                        $('.error-message-emailprofile').html("Вы не указали E-Mail в профиле!");
                        $('.error-message-emailprofile').fadeIn(300);
                        $('.error-message-emailprofile').fadeOut(1000);
                        return;
                    }else if(data == 'Возраст слишком мал!') {
                        $('.post').css('display', 'none');
    
                        $('.error-message-emailprofile').html("Ваш возраст не подходит для данных книг!");
                        $('.error-message-emailprofile').fadeIn(300);
                        $('.error-message-emailprofile').fadeOut(2400);
                        return;
                    }
                    else if(data == 'Книги успешно отправлены!') {
                        $('.post').css('display', 'none');
                        $('.post-end').css('display', 'inline');
                        $('.post-end').fadeOut(1000);
    
                        $('.error-message-emailprofile').html("Книга была выслана на почту, которая указана в профиле!");
                        $('.error-message-emailprofile').fadeIn(300);
                        $('.error-message-emailprofile').fadeOut(2400);
    
                        $('.clear').click();
                        return;
                    }
                })
        }
    })
    $(document).on('click', '.payment', function () {
        event.preventDefault();
        if($('.heading span').html() !== '0'){
            alert("В настоящее время оплата товара недоступна!");
            return;
        }else{

        }
    })
    /* */
    $('.catalog-books').mouseenter(function () {
        $('.catalog_list').slideDown(100);
        $('.catalog_list').addClass('switch');
    })
    $('.catalog_list').mouseleave(function () {
        $('.catalog_list').slideUp(100);
        $('.catalog_list').removeClass('switch');
    })

    $(document).on('click', '.dropdown-menu.dropdown-menu-right-cat a', function () {
        event.preventDefault();
        var category = $(this).attr('href');
        $(".btn.btn-primary.dropdown-toggle.cat").val(category);
    })
    $(document).on('click', '.dropdown-menu.dropdown-menu-right-pub a', function () {
        event.preventDefault();
        var publish = $(this).attr('href');
        $(".btn.btn-primary.dropdown-toggle.pub").val(publish);
    })
    /*Стиль*/
    $(document).on('click', '.logo', function () {
        $('div.logo-popup').fadeIn(300);
        $('div.logo-popup').fadeOut(600);
    })

    function include(url) {
        var script = document.createElement('script');
        script.src = url;
        document.getElementsByTagName('head')[0].appendChild(script);
    }

    $('.open-popup').click(function (e) {
        e.preventDefault();
        $('.popup-bg-auth').fadeIn(800);
        $('html').addClass('no-scroll');
        $(".error-message-auth").hide();
    });

    $('.close-popup-auth').click(function () {
        $('.popup-bg-auth').fadeOut(800);
        $('html').removeClass('no-scroll');
    });

    $('.reg-popup').click(function () {
        $('.popup-bg-auth').fadeOut(800);
        $('.popup-bg-reg').fadeIn(800);
        $('html').removeClass('no-scroll');
    });
    $('.close-popup-reg').click(function () {
        $('.popup-bg-reg').fadeOut(800);
        $('html').removeClass('no-scroll');
    });

    $('.addiction-category').click(function () {
        $('.popup-bg-category').fadeIn(800);
        $('html').addClass('no-scroll');
    });
    $('.close-popup-category').click(function () {
        $('.popup-bg-category').fadeOut(800);
        $('html').removeClass('no-scroll');
    });

    $('.addiction-publish').click(function () {
        $('.popup-bg-publish').fadeIn(800);
        $('html').addClass('no-scroll');
    });
    $('.close-popup-publish').click(function () {
        $('.popup-bg-publish').fadeOut(800);
        $('html').removeClass('no-scroll');
    });
    $('.reports').click(function () {
        event.preventDefault();
        $.get(
            'str/admin-content-str/reports.php',
            function onAjaxSuccess(data) {
                document.getElementById('page-content').innerHTML = data;
            })
    });
    $('.addiction-book').click(function () {
        event.preventDefault();
        $.get(
            'str/admin-content-str/reports.php',
            function onAjaxSuccess(data) {
                document.getElementById('page-content').innerHTML = data;
            })
    });
    $(document).on('click', '.btn.btn-round.btn-danger.addbook', function () {
        event.preventDefault();
        var data = new FormData(addbook);

        var img_book = $('#book_file').prop('files')[0];
        var pdf_book = $('#book_pdf').prop('files')[0];
        var cat_book = $('.btn.btn-primary.dropdown-toggle.cat').val();
        var pub_book = $('.btn.btn-primary.dropdown-toggle.pub').val();

        data.append('file', img_book);
        data.append('filepdf', pdf_book);
        data.append('book_category', cat_book);
        data.append('book_publish', pub_book);
        if (data.get('book_name').length == 0) {
            $('.error-message-addiction-book.namebook').html("Данное поле должно быть заполнено!");
            $('.error-message-addiction-book.namebook').fadeIn(300);
            $('.error-message-addiction-book.namebook').fadeOut(1000);
            return;
        }
        if (data.get('book_author').length == 0) {
            $('.error-message-addiction-book.author').html("Данное поле должно быть заполнено!");
            $('.error-message-addiction-book.author').fadeIn(300);
            $('.error-message-addiction-book.author').fadeOut(1000);
            return;
        }
        if (data.get('book_author').length == 0) {
            $('.error-message-addiction-book.author').html("Данное поле должно быть заполнено!");
            $('.error-message-addiction-book.author').fadeIn(300);
            $('.error-message-addiction-book.author').fadeOut(1000);
            return;
        }
        if (data.get('book_annotation').length == 0) {
            $('.error-message-addiction-book.annotation').html("Данное поле должно быть заполнено!");
            $('.error-message-addiction-book.annotation').fadeIn(300);
            $('.error-message-addiction-book.annotation').fadeOut(1000);
            return;
        }
        if (cat_book == "Категория") {
            $('.error-message-addiction-book.category').html("Данное поле должно быть заполнено!");
            $('.error-message-addiction-book.category').fadeIn(300);
            $('.error-message-addiction-book.category').fadeOut(1000);
            return;
        }
        if (pub_book == "Издательство") {
            $('.error-message-addiction-book.publish').html("Данное поле должно быть заполнено!");
            $('.error-message-addiction-book.publish').fadeIn(300);
            $('.error-message-addiction-book.publish').fadeOut(1000);
            return;
        }
        if (data.get('book_year').length == 0) {
            $('.error-message-addiction-book.year').html("Данное поле должно быть заполнено!");
            $('.error-message-addiction-book.year').fadeIn(300);
            $('.error-message-addiction-book.year').fadeOut(1000);
            return;
        }
        if (data.get('book_page').length == 0) {
            $('.error-message-addiction-book.page').html("Данное поле должно быть заполнено!");
            $('.error-message-addiction-book.page').fadeIn(300);
            $('.error-message-addiction-book.page').fadeOut(1000);
            return;
        }
        if (data.get('book_sbn').length == 0) {
            $('.error-message-addiction-book.isbn').html("Данное поле должно быть заполнено!");
            $('.error-message-addiction-book.isbn').fadeIn(300);
            $('.error-message-addiction-book.isbn').fadeOut(1000);
            return;
        }
        if (data.get('book_age').length == 0) {
            $('.error-message-addiction-book.age').html("Данное поле должно быть заполнено!");
            $('.error-message-addiction-book.age').fadeIn(300);
            $('.error-message-addiction-book.age').fadeOut(1000);
            return;
        }
        if (data.get('book_price').length == 0) {
            $('.error-message-addiction-book.price').html("Данное поле должно быть заполнено!");
            $('.error-message-addiction-book.price').fadeIn(300);
            $('.error-message-addiction-book.price').fadeOut(1000);
            return;
        }
        if (img_book == null) {
            $('.error-message-addiction-book.img').html("Фотография книги обязательна для добавления");
            $('.error-message-addiction-book.img').fadeIn(300);
            $('.error-message-addiction-book.img').fadeOut(1000);
            return;
        }
        $.ajax({
            url: 'modules/admin-content-modules/product-addiction.php',
            method: 'post',
            dataType: 'html',
            contentType: false,
            processData: false,
            cache: false,
            type: 'post',
            data: data,
            success: function (data) {
                if (data == "Книга успешно добавлена!") {
                    $('.error-message-addiction-book.addiction').html("Книга успешно добавлена!");
                    $('.error-message-addiction-book.addiction').fadeIn(300);
                    $('.error-message-addiction-book.addiction').fadeOut(1000);
                }
            }
        })

    })
    $(document).on('click', '.amounts', function () {
        $(".amounts").replaceWith("<a href='#' style='cursor:pointer; color: rgba(246, 48, 112, 1); padding: 0 20px' class='m-l-10 amount'>OK</a></td>");
        $(".amountttt").append("<td class='u_amount'><input type='text' name='book_amount' placeholder='1' class='form-control' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-sm'></td>");
    });
    $(document).on('click', '.amount', function () {
        event.preventDefault();
        var data = new FormData(addamount);
        var link_url = $('.id-boo').attr('href');
        var am = data.get('book_amount');

        amont_int = parseInt($('.am-boo').text(), 10) + 0;
        am_int = parseInt(data.get('book_amount'), 10) + 0;
        if (am.length == 0) {
            $('.error-message-addiction-book.amountsss').html("Данное поле должно быть заполнено!");
            $('.error-message-addiction-book.amountsss').fadeIn(300);
            $('.error-message-addiction-book.amountsss').fadeOut(1000);
            return;
        }
        data.append('book_id', link_url);
        $.ajax({
            url: 'modules/admin-content-modules/amount-addiction.php',
            method: 'post',
            dataType: 'html',
            contentType: false,
            processData: false,
            cache: false,
            type: 'post',
            data: data,
            success: function (data) {
                if (data == "Книга была обновлена!") {
                    $('.error-message-addiction-book.amountsss').html("Книга была обновлена!");
                    $('.error-message-addiction-book.amountsss').fadeIn(300);
                    $('.error-message-addiction-book.amountsss').fadeOut(1000);
                    $('.am-boo').html(amont_int + am_int);
                    $(".u_amount").remove();
                    $(".amount").replaceWith("<a href='#' style='cursor:pointer; color: rgba(246, 48, 112, 1); padding: 0 20px;' class='m-l-10 amounts'>Изменить</a></td>");
                }
            }
        })

    })
    $(document).on('click', '.discounts', function () {
        $(".discounts").replaceWith("<a href='#' style='cursor:pointer; color: rgba(246, 48, 112, 1); padding: 0 20px;' class='m-l-10 discount'>OK</a></td>");
        $(".discountttt").append("<td class='u_discount'><input type='text' name='book_discount' id='b_disc' placeholder='1' class='form-control' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-sm'></td>");
    });
    $(document).on('click', '.clear', function () {
        $.get(
            'modules/cart-modules/cart-delete-all.php', {
            },
            function onAjaxSuccess(data) {
                if (data == "Корзина очищена!") {
                    $.get(
                        'modules/user-content-modules/basket-popup/basket-content-ajax.php',
                        function onAjaxSuccess(data) {
                            $('.minicart-product-list').html(data);
                        })
                    $.get(
                        'modules/cart-modules/cart-content-ajax.php',
                        function onAjaxSuccess(data) {
                            $('.testttt').html(data);
                        })
                    $.get(
                        'modules/cart-modules/cart-price.php',
                         function onAjaxSuccess(data) {
                            $('.price-result').html(data);
                        })
                    $.get(
                        'modules/user-content-modules/basket-popup/basket-popup-price.php',
                        function onAjaxSuccess(data) {
                            if (data <= 0) {
                                $('.price').html("0");
                            } else {
                                $('.price').html(data);
                            }
                        })
                    $.get(
                        'modules/user-content-modules/basket-popup/basket-count-ajax.php',
                        function onAjaxSuccess(data) {
                            $('.count-basket').html(data);
                        })
                }
            })
    })
    $(document).on('click', '.reserve-cart', function () {
        event.preventDefault();
        $.get(
            'str/user-content-str/reserve-cart.php', {
            },
            function onAjaxSuccess(data) {
                document.getElementById('page-content').innerHTML = data;
                $('.offcanvas-close').click();
            })
    })
    $(document).on('click', '.reserve-clear', function () {
        event.preventDefault();
        $.get(
            'modules/reserve-cart-modules/cart-delete-all.php', {

            },
            function onAjaxSuccess(data) {
                if (data == "Корзина очищена!") {
                    $.get(
                        'modules/reserve-cart-modules/cart-content-ajax.php',
                        function onAjaxSuccess(data) {
                            $('.testttt').html(data);
                        })
                }
            })
    })
    $(document).on('click', '.discount', function () {
        event.preventDefault();
        var data = new FormData(adddisc);
        var link_url = $('.id-boo').attr('href');
        var disc = $('#b_disc').val();
        if (disc.length == 0) {
            $('.error-message-addiction-book.discountsss').html("Данное поле должно быть заполнено!");
            $('.error-message-addiction-book.discountsss').fadeIn(300);
            $('.error-message-addiction-book.discountsss').fadeOut(1000);
            return;
        }
        data.append('book_id', link_url);
        $.ajax({
            url: 'modules/admin-content-modules/discount-addiction.php',
            method: 'post',
            dataType: 'html',
            contentType: false,
            processData: false,
            cache: false,
            type: 'post',
            data: data,
            success: function (data) {
                if (data == "Скидка была установлена!") {
                    $('.error-message-addiction-book.discountsss').html("Скидка была установлена!");
                    $('.error-message-addiction-book.discountsss').fadeIn(300);
                    $('.error-message-addiction-book.discountsss').fadeOut(1000);
                    $('.discc').html(disc + " %");
                    $(".u_discount").remove();
                    $(".discount").replaceWith("<a href='#' style='cursor:pointer; color: rgba(246, 48, 112, 1); padding: 0 20px;' class='m-l-10 discounts'>Изменить</a></td>");
                }
            }
        })

    })
    $(document).on('click', '.buy', function () {
        var that = $(this).closest('.b_content').find('img');
        var bascket = $(".busket-menu");
        var w = that.width();
        that.clone().css({
                'width': w,
                'position': 'absolute',
                'z-index': '9999',
                'height': '250px',
                top: that.offset().top,
                left: that.offset().left
            })
            .appendTo("body")
            .animate({
                opacity: 0.05,
                left: bascket.offset()['left'],
                top: bascket.offset()['top'],
                width: 5
            }, 1000, function () {
                $(this).remove();
            });
    });
    $(document).on('click', '.delete-book-to-cart', function () {
        event.preventDefault();
        link_url = $(this).attr('href');

        $.get(
            'modules/user-content-modules/basket-popup/basket-popup-deletebook.php', {
                book_id: link_url,
            },
            function onAjaxSuccess(data) {
                if (data == "Книга успешно обновлена!") {
                    $.get(
                        'modules/user-content-modules/basket-popup/basket-content-ajax.php',
                        function onAjaxSuccess(data) {
                            $('.minicart-product-list').html(data);
                        })
                    $.get(
                        'modules/cart-modules/cart-content-ajax.php',
                        function onAjaxSuccess(data) {
                            $('.testttt').html(data);
                        })
                    $.get(
                        'modules/cart-modules/cart-price.php',
                         function onAjaxSuccess(data) {
                            $('.price-result').html(data);
                        })
                    $.get(
                        'modules/user-content-modules/basket-popup/basket-popup-price.php',
                        function onAjaxSuccess(data) {
                            if (data <= 0) {
                                $('.price').html("0");
                            } else {
                                $('.price').html(data);
                            }
                        })
                    $.get(
                        'modules/user-content-modules/basket-popup/basket-count-ajax.php',
                        function onAjaxSuccess(data) {
                            $('.count-basket').html(data);
                        })
                }
            })
    })
    $(document).on('click', '.delete-book-to-cart-reserve', function () {
        event.preventDefault();
        link_url = $(this).attr('href');
        $.get(
            'modules/user-content-modules/basket-popup/basket-reserve-deletebook.php', {
                book_id: link_url,
            },
            function onAjaxSuccess(data) {
                if (data == "Книга успешно обновлена!") {
                    $.get(
                        'modules/reserve-cart-modules/cart-content-ajax.php',
                        function onAjaxSuccess(data) {
                            $('.testttt').html(data);
                        })
                }
            })
    })
    $(document).on('click', 'li .content .remove-basket', function () {
        event.preventDefault();
        link_url = $(this).attr('href');
        $.get(
            'modules/user-content-modules/basket-popup/basket-popup-deletebook.php', {
                book_id: link_url,
            },
            function onAjaxSuccess(data) {
                if (data == "Книга успешно обновлена!") {
                    $.get(
                        'modules/user-content-modules/basket-popup/basket-content-ajax.php',
                        function onAjaxSuccess(data) {
                            $('.minicart-product-list').html(data);
                        })
                    $.get(
                        'modules/cart-modules/cart-content-ajax.php',
                        function onAjaxSuccess(data) {
                            $('.book' + link_url).html(data);
                        })
                    $.get(
                        'modules/user-content-modules/basket-popup/basket-popup-price.php',
                        function onAjaxSuccess(data) {
                            if (data <= 0) {
                                $('.price').html("0");
                            } else {
                                $('.price').html(data);
                            }
                        })
                }
            })
    })
    $(document).on('click', '.basket-click', function () {
        $('#offcanvas-cart').fadeIn(800);
        $('#offcanvas-cart').addClass('offcanvas-open');
    })
    check_one = false;
    $(document).on('click', '.pin-menu', function () {
        event.preventDefault();
        if (check_one == false) {
            $('.admin-menu').css('top', '0px');
            $('.admin-menu').css('position', 'fixed');
            $('.admin-menu').css('z-index', '9999');
            $('.admin-menu').css('display', 'unset');
            $('.admin-menu').css('width', '100%');
            check_one = true;
        } else {
            $('.admin-menu').css('display', 'block');
            $('.admin-menu').css('position', '');
            $('.admin-menu').css('z-index', '');
            check_one = false;
        }
    })
    $(document).on('click', '.offcanvas-close', function () {
        $.get(
            'modules/user-content-modules/basket-popup/basket-count-ajax.php',
            function onAjaxSuccess(data) {
                $('.count-basket').html(data);
            })
        $('#offcanvas-cart').fadeIn(800);
        $('#offcanvas-cart').removeClass('offcanvas-open');
    })
    $('.close-popup-book').click(function () {
        $('.popup-bg-book').fadeOut(800);
        $('html').removeClass('no-scroll');
    });
    $('input[type="file"]').change(function () {
        var value = $("input[type='file']").val();
        $('.title-js').text(value);
    });
    $(document).on('click', '.dropdown-menu.dropdown-menu-right-user a.profile-page', function () {
        event.preventDefault();
        $.get(
            'str/account/profile.php',
            function onAjaxSuccess(data) {
                document.getElementById('page-content').innerHTML = data;
                $(".menu.catalog-menu").hide();
                $(".fd-pass").hide();
                $(".t-pass_two").hide();
                $(".twopass").hide();
            })
    })
    $(document).on('click', '.searching', function () {
        event.preventDefault();
        var txt = $('#search').val();
        var data = new FormData(searchhh);
        data.append('search', txt);
        if(txt != ''){
            $('#s_result').css('display', 'block');
            $.ajax({
                url: 'modules/user-content-modules/content-search.php',
                method: 'post',
                dataType: 'html',
                contentType: false,
                processData: false,
                cache: false,
                type: 'post',
                data: data,
                success: function (data) {
                    if(data !== null){
                        document.getElementById('page-content').innerHTML = data;
                        $('#s_result').css('display', 'none');
                        $('#searchhh')[0].reset();
                    }
                }
            })
        }
    })
    $('#search').keyup(function(){
        var txt = $(this).val();
        var data = new FormData(searchhh);
        data.append('search', txt);
        if(txt != '' && txt.length >= 2){
            $('#s_result').css('display', 'block');
            $.ajax({
                url: 'modules/user-content-modules/search.php',
                method: 'post',
                dataType: 'html',
                contentType: false,
                processData: false,
                cache: false,
                type: 'post',
                data: data,
                success: function (data) {
                    $('#s_result').html(data);
                }
            })
        }else{
            $('#s_result').css('display', 'none');
        }
    })
    function Hide() {
        $("#error-message-reg").hide();
        $(".error-message-reg.lastname").hide();
        $(".error-message-reg.name").hide();
        $(".error-message-reg.number").hide();
        $(".error-message-reg.lastname").hide();
        $(".error-message-reg.passone").hide();
        $(".error-message-reg.passtwo").hide();

        $(".error-message-emailprofile").hide();
    }
    Hide();
})(jQuery);