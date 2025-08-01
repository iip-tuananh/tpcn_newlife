var app = angular.module(
    "App",
    ["ui.sortable", "ui.select", "ngSanitize", "dndLists"],
    function ($interpolateProvider) {
        $interpolateProvider.startSymbol("<%");
        $interpolateProvider.endSymbol("%>");
    }
);

app.run(function ($rootScope, $sce) {
    $rootScope.trustAsHtml = function (html) {
        return $sce.trustAsHtml(html);
    };
});

// app.factory('cartItemSync', function($interval) {
//     var cart = {items: null, total: null};
//
//     return cart;
// });

app.run(function ($rootScope) {
    $rootScope.calculateTime = function (time) {
        if (!time) return "Vài giây trước";
        time = new Date(time).getTime();
        var now = Date.now();
        var diff = now - time;
        if (diff < 0) return "";
        if (Math.round(diff / 31536000000) > 0)
            return Math.round(diff / 31536000000) + " năm trước";
        if (Math.round(diff / 2592000000) > 0)
            return Math.round(diff / 2592000000) + " tháng trước";
        if (Math.round(diff / 604800000) > 0)
            return Math.round(diff / 604800000) + " tuần trước";
        if (Math.round(diff / 86400000) > 0)
            return Math.round(diff / 86400000) + " ngày trước";
        if (Math.round(diff / 3600000) > 0)
            return Math.round(diff / 3600000) + " giờ trước";
        if (Math.round(diff / 60000) > 0)
            return Math.round(diff / 60000) + " phút trước";
        return "Vài giây trước";
    };
});

app.directive("ckEditor", function() {
    return {
        require: "?ngModel",
        scope: {
            height: "@"
        },
        link: function(scope, elm, attr, ngModel) {
            var ck = CKEDITOR.replace(elm[0], {
                allowedContent: {
                    $1: {
                        // Use the ability to specify elements as an object.
                        elements: CKEDITOR.dtd,
                        attributes: true,
                        styles: true,
                        classes: true
                    }
                },
                disallowedContent: "script; *[on*]",
                extraAllowedContent: 'div[data-oembed-url]; iframe[*];',
                height: scope.height || 350,
                basicEntities: false,
                enterMode: CKEDITOR.ENTER_DIV,
                bodyClass: "document-editor",
                extraPlugins: "tableresize,pastefromword,lineheight,youtubebutton",
                line_height: "1;1.2;1.5;2;3;4",
                toolbar: [
                    { name: "document", items: ["Source"] },
                    {
                        name: "editing",
                        items: ["Find", "Replace", "-", "SelectAll"]
                    },
                    {
                        name: "clipboard",
                        items: [
                            "Cut",
                            "Copy",
                            "Paste",
                            "PasteText",
                            "PasteFromWord",
                            "-",
                            "Undo",
                            "Redo"
                        ]
                    },
                    { name: "forms", items: ["Checkbox", "Radio"] },
                    {
                        name: "basicstyles",
                        items: [
                            "Bold",
                            "Italic",
                            "Underline",
                            "Strike",
                            "RemoveFormat"
                        ]
                    },
                    {
                        name: "paragraph",
                        items: [
                            "NumberedList",
                            "BulletedList",
                            "-",
                            "Outdent",
                            "Indent",
                            "-",
                            "JustifyLeft",
                            "JustifyCenter",
                            "JustifyRight",
                            "JustifyBlock"
                        ]
                    },
                    {
                        name: "insert",
                        items: [
                            "Image",
                            "YouTube",
                            "Table",
                            "HorizontalRule",
                            "SpecialChar",
                            "PageBreak"
                        ]
                    },
                    { name: "links", items: ["Link", "Unlink", "Anchor"] },
                    "/",
                    {
                        name: "styles",
                        items: [
                            "Styles",
                            "Format",
                            "Font",
                            "FontSize",
                            "lineheight"
                        ]
                    },
                    { name: "colors", items: ["TextColor", "BGColor"] },
                    { name: "tools", items: ["Maximize"] }
                ]
            });

            if (!ngModel) return;

            ck.on("instanceReady", function() {
                ck.setData(ngModel.$viewValue);
            });

            function updateModel() {
                scope.$apply(function() {
                    ngModel.$setViewValue(ck.getData());
                });
            }

            ck.on("change", updateModel);
            ck.on("key", updateModel);
            ck.on("dataReady", updateModel);
            ck.on("blur", updateModel);

            ck.on("pasteState", function() {
                scope.$apply(function() {
                    ngModel.$setViewValue(ck.getData());
                });
            });

            ngModel.$render = function(value) {
                ck.setData(ngModel.$viewValue);
            };
        }
    };
})
    .directive("ckEditorPrint", function () {
        return {
            require: "?ngModel",
            link: function (scope, elm, attr, ngModel) {
                var ck = CKEDITOR.replace(elm[0], {
                    allowedContent: {
                        $1: {
                            // Use the ability to specify elements as an object.
                            elements: CKEDITOR.dtd,
                            attributes: true,
                            styles: true,
                            classes: true,
                        },
                    },
                    disallowedContent: "script; *[on*]",
                    height: 350,
                    basicEntities: false,
                    enterMode: CKEDITOR.ENTER_DIV,
                    bodyClass: "document-editor",
                    extraPlugins: "tableresize,pastefromword,lineheight",
                    line_height: "1;1.2;1.5;2;3;4",
                    toolbar: [
                        { name: "document", items: ["Source"] },
                        {
                            name: "editing",
                            items: ["Find", "Replace", "-", "SelectAll"],
                        },
                        {
                            name: "clipboard",
                            items: [
                                "Cut",
                                "Copy",
                                "Paste",
                                "PasteText",
                                "PasteFromWord",
                                "-",
                                "Undo",
                                "Redo",
                            ],
                        },
                        { name: "forms", items: ["Checkbox", "Radio"] },
                        {
                            name: "basicstyles",
                            items: [
                                "Bold",
                                "Italic",
                                "Underline",
                                "Strike",
                                "RemoveFormat",
                            ],
                        },
                        {
                            name: "paragraph",
                            items: [
                                "NumberedList",
                                "BulletedList",
                                "-",
                                "Outdent",
                                "Indent",
                                "-",
                                "JustifyLeft",
                                "JustifyCenter",
                                "JustifyRight",
                                "JustifyBlock",
                            ],
                        },
                        {
                            name: "insert",
                            items: [
                                "Image",
                                "Table",
                                "HorizontalRule",
                                "SpecialChar",
                                "PageBreak",
                            ],
                        },
                        "/",
                        {
                            name: "styles",
                            items: [
                                "Styles",
                                "Format",
                                "Font",
                                "FontSize",
                                "lineheight",
                            ],
                        },
                        { name: "colors", items: ["TextColor", "BGColor"] },
                        { name: "tools", items: ["Maximize"] },
                    ],
                    contentsCss: ["/css/yield-css/editor.css"],
                });

                if (!ngModel) return;

                ck.on("instanceReady", function () {
                    ck.setData(ngModel.$viewValue);
                });

                function updateModel() {
                    scope.$apply(function () {
                        ngModel.$setViewValue(ck.getData());
                    });
                }

                ck.on("change", updateModel);
                ck.on("key", updateModel);
                ck.on("dataReady", updateModel);
                ck.on("blur", updateModel);

                ck.on("pasteState", function () {
                    scope.$apply(function () {
                        ngModel.$setViewValue(ck.getData());
                    });
                });

                ngModel.$render = function (value) {
                    ck.setData(ngModel.$viewValue);
                };
            },
        };
    })
    .filter("toDate", function () {
        return function (items) {
            return new Date(items);
        };
    })
    .filter("my_number", function () {
        return function (x) {
            if (!x) return 0;
            x = roundNumber(x, 2);
            return x.toLocaleString("en");
        };
    })
    .directive("select2", function () {
        return {
            restrict: "A",
            require: "ngModel",
            link: function (scope, element, attr, ngModel) {
                let modal = $(element).closest(".modal-content");
                if (modal.length) $(element).select2({ dropdownParent: modal });
                else $(element).select2({});

                $(element).on("change", function () {
                    let val = $(this).val();
                    scope.$apply(function () {
                        //will cause the ng-model to be updated.
                        ngModel.$setViewValue(val);
                    });
                });

                ngModel.$render = function () {
                    //if this is called, the model was changed outside of select, and we need to set the value
                    //not sure what the select2 api is, but something like:
                    $(element).val(ngModel.$viewValue).trigger("change");
                };
            },
        };
    })
    .directive("date", function () {
        return {
            restrict: "A",
            require: "ngModel",
            link: function (scope, element, attr, ngModel) {
                $(element).datetimepicker({
                    timepicker: false,
                    format: "d/m/Y",
                });

                $(element).on("change", function () {
                    let val = $(this).val();
                    scope.$apply(function () {
                        //will cause the ng-model to be updated.
                        setTimeout(() => {
                            ngModel.$setViewValue(val);
                        });
                    });
                });
            },
        };
    })
    .directive("datetime", function () {
        return {
            restrict: "A",
            require: "ngModel",
            link: function (scope, element, attr, ngModel) {
                $(element).datetimepicker({
                    format: "H:i d/m/Y",
                });

                $(element).on("change", function () {
                    let val = $(this).val();
                    scope.$apply(function () {
                        //will cause the ng-model to be updated.
                        setTimeout(() => {
                            ngModel.$setViewValue(val);
                        });
                    });
                });
            },
        };
    })
    .directive("dateForm", function () {
        return {
            restrict: "A",
            require: "ngModel",
            link: function (scope, element, attr, ngModel) {
                $(element).datetimepicker({
                    timepicker: false,
                    format: "d/m/Y",
                });

                $(element).on("change", function () {
                    let val = $(this).val();
                    scope.$apply(function () {
                        //will cause the ng-model to be updated.
                        setTimeout(() => {
                            ngModel.$setViewValue(val);
                        });
                    });
                });

                if (ngModel) {
                    ngModel.$parsers.push(function (value) {
                        return dateSetter(value);
                    });

                    ngModel.$formatters.push(function (value) {
                        return dateGetter(value);
                    });
                }
            },
        };
    })
    .directive("datetimeForm", function () {
        return {
            restrict: "A",
            require: "ngModel",
            link: function (scope, element, attr, ngModel) {
                $(element).datetimepicker({
                    format: "H:i d/m/Y",
                });

                $(element).on("change", function () {
                    let val = $(this).val();
                    scope.$apply(function () {
                        //will cause the ng-model to be updated.
                        setTimeout(() => {
                            ngModel.$setViewValue(val);
                        });
                    });
                });

                if (ngModel) {
                    ngModel.$parsers.push(function (value) {
                        return dateSetter(
                            value,
                            "HH:mm DD/MM/YYYY",
                            "YYYY-MM-DD HH:mm"
                        );
                    });

                    ngModel.$formatters.push(function (value) {
                        return dateGetter(
                            value,
                            "YYYY-MM-DD HH:mm",
                            "HH:mm DD/MM/YYYY"
                        );
                    });
                }
            },
        };
    })
    .directive("select2MultiAjax", function () {
        return {
            restrict: "A",
            scope: {
                model: "=ngModel",
                url: "@",
                placeholder: "@",
            },
            link: function (scope, element, attrs) {
                var $el = $(element);

                $el.select2({
                    multiple: true,
                    ajax: {
                        url: scope.url,
                        dataType: "json",
                        delay: 250,
                        data: function (params) {
                            return {
                                keyword: params.term || "", // term có thể rỗng
                            };
                        },
                        processResults: function (data) {
                            return {
                                results: data.map(function (item) {
                                    return { id: item.id, text: item.name };
                                }),
                            };
                        },
                        cache: true,
                    },
                    placeholder: scope.placeholder || "Chọn mục",
                    minimumInputLength: 0, // Cho phép click mở dropdown mà không cần gõ
                    width: "100%",
                });

                // Đồng bộ ngModel
                $el.on("change", function () {
                    scope.$apply(function () {
                        scope.model = $el.val();
                    });
                });

                // Khi model thay đổi bên ngoài
                scope.$watch("model", function (newVal) {
                    $el.val(newVal).trigger("change");
                });
            },
        };
    })
    .directive("select2MultiModalAjax", function ($timeout, $http) {
        return {
            restrict: "A",
            scope: {
                model: "=ngModel",
                url: "@",
                placeholder: "@",
                modalSelector: "@",
            },
            link: function (scope, element) {
                var $el = $(element);

                function initSelect2() {
                    if ($el.hasClass("select2-hidden-accessible")) {
                        $el.select2("destroy");
                    }

                    var dropdownParent = scope.modalSelector
                        ? $(scope.modalSelector)
                        : $("body");

                    $el.select2({
                        multiple: true,
                        ajax: {
                            url: scope.url,
                            dataType: "json",
                            delay: 250,
                            data: function (params) {
                                return {
                                    keyword: params.term || "",
                                };
                            },
                            processResults: function (data) {
                                return {
                                    results: data.map(function (item) {
                                        return {
                                            id: item.id,
                                            text: item.name,
                                        };
                                    }),
                                };
                            },
                            cache: true,
                        },
                        placeholder: scope.placeholder || "Chọn mục",
                        minimumInputLength: 0,
                        width: "100%",
                        dropdownParent: dropdownParent,
                    });

                    $el.on("change", function () {
                        var selected = $el.val();
                        if (!angular.equals(scope.model, selected)) {
                            scope.$evalAsync(function () {
                                scope.model = selected;
                            });
                        }
                    });

                    // Load dữ liệu ban đầu (chỉ khi edit)
                    if (scope.model && scope.model.length > 0) {
                        console.log(scope.model);
                        $http
                            .get(scope.url, {
                                params: { ids: [scope.model] },
                            })
                            .then(function (response) {
                                const data = response.data;
                                console.log(data);
                                const selectedOptions = data.map(function (item) {
                                    const option = new Option(
                                        item.name,
                                        item.id,
                                        true,
                                        true
                                    );
                                    $el.append(option);
                                    return item.id;
                                });
                                $el.trigger("change");
                            });
                    }
                }

                $timeout(function () {
                    initSelect2();
                });

                scope.$watch(
                    "model",
                    function (newVal) {
                        $timeout(function () {
                            var currentVal = $el.val();
                            if (!angular.equals(currentVal, newVal)) {
                                $el.val(newVal).trigger("change");
                            }
                        });
                    },
                    true
                );
            },
        };
    })
    .directive("select2ModalAjax", function ($timeout, $http) {
        return {
            restrict: "A",
            scope: {
                model: "=ngModel",
                url: "@",
                placeholder: "@",
                modalSelector: "@",
            },
            link: function (scope, element) {
                var $el = $(element);

                function initSelect2() {
                    if ($el.hasClass("select2-hidden-accessible")) {
                        $el.select2("destroy");
                    }

                    var dropdownParent = scope.modalSelector
                        ? $(scope.modalSelector)
                        : $("body");

                    $el.select2({
                        multiple: false,
                        ajax: {
                            url: scope.url,
                            dataType: "json",
                            delay: 250,
                            data: function (params) {
                                return {
                                    keyword: params.term || "",
                                };
                            },
                            processResults: function (data) {
                                return {
                                    results: data.map(function (item) {
                                        return {
                                            id: item.id,
                                            text: item.name,
                                        };
                                    }),
                                };
                            },
                            cache: true,
                        },
                        placeholder: scope.placeholder || "Chọn mục",
                        minimumInputLength: 0,
                        width: "100%",
                        dropdownParent: dropdownParent,
                    });

                    $el.on("change", function () {
                        var selected = $el.val();
                        if (!angular.equals(scope.model, selected)) {
                            scope.$evalAsync(function () {
                                scope.model = selected;
                            });
                        }
                    });

                    // Load dữ liệu ban đầu (chỉ khi edit)
                    if (scope.model && scope.model.length > 0) {
                        console.log(scope.model);
                        $http
                            .get(scope.url, {
                                params: { ids: [scope.model] },
                            })
                            .then(function (response) {
                                const data = response.data;
                                console.log(data);
                                const selectedOptions = data.map(function (item) {
                                    const option = new Option(
                                        item.name,
                                        item.id,
                                        true,
                                        true
                                    );
                                    $el.append(option);
                                    return item.id;
                                });
                                $el.trigger("change");
                            });
                    }
                }

                $timeout(function () {
                    initSelect2();
                });

                scope.$watch(
                    "model",
                    function (newVal) {
                        $timeout(function () {
                            var currentVal = $el.val();
                            if (!angular.equals(currentVal, newVal)) {
                                $el.val(newVal).trigger("change");
                            }
                        });
                    },
                    true
                );
            },
        };
    })
    .directive("currency", function () {
        return {
            restrict: "A",
            require: "ngModel",
            link: function (scope, element, attr, ngModel) {
                $(element).on("change input keyup", function () {
                    let val = $(this).val();
                    scope.$apply(function () {
                        setTimeout(() => {
                            ngModel.$modelValue = val;
                        });
                    });
                });

                if (ngModel) {
                    ngModel.$parsers.push(function (value) {
                        // console.log(value)
                        return parseNumberString(value);
                    });

                    ngModel.$formatters.push(function (value) {
                        return value != null
                            ? Number(value).toLocaleString("en")
                            : "";
                    });
                }
            },
        };
    });
