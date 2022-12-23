"use strict";

var KTTreeview = function () {

    var _demo1 = function () {
        $('#kt_tree_1').jstree({
            "core" : {
                "themes" : {
                    "responsive": false
                }
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder"
                },
                "file" : {
                    "icon" : "fa fa-file"
                }
            },
            "plugins": ["types"]
        });
    }

    var _demo2 = function () {
        $('#kt_tree_2').jstree({
            "core" : {
                "themes" : {
                    "responsive": true
                },
                // so that create works
                "check_callback" : true,
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder text-primary"
                },
                "file" : {
                    "icon" : "fa fa-file  text-primary"
                }
            },
            "state" : { "key" : "demo2" },
            "plugins" : [ "contextmenu", "state", "types" ]
        });

        // handle link clicks in tree nodes(support target="_blank" as well)
        $('#kt_tree_2').on('select_node.jstree', function(e,data) {
            var link = $('#' + data.selected).find('a');
            if (link.attr("href") != "#" && link.attr("href") != "javascript:;" && link.attr("href") != "") {
                if (link.attr("target") == "_blank") {
                    link.attr("href").target = "_blank";
                }
                document.location.href = link.attr("href");
                return false;
            }
        });
    }



    var _demo4 = function() {
        $("#kt_tree_4").jstree({
            
            "core" : {
                "themes" : {
                    "responsive": true
                },
                // so that create works
                "check_callback" : true,
                'data': [{
                        "text": "Parent Node",
                        
                    },
                    "Another Node"
                ]
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder text-primary"
                },
                "file" : {
                    "icon" : "fa fa-file  text-primary"
                }
            },
            "state" : { "key" : "demo2" },
            "plugins" : [ "contextmenu", "state", "types" ]
        });
         // handle link clicks in tree nodes(support target="_blank" as well)
         $('#kt_tree_4').on('select_node.jstree', function(e,data) {
            var link = $('#' + data.selected).find('a');
            if (link.attr("href") != "#" && link.attr("href") != "javascript:;" && link.attr("href") != "") {
                if (link.attr("target") == "_blank") {
                    link.attr("href").target = "_blank";
                }
                document.location.href = link.attr("href");
                return false;
            }
        });
    }


    return {
        //main function to initiate the module
        init: function () {
           
            _demo2();
            _demo4();
        }
    };
}();

jQuery(document).ready(function() {
    KTTreeview.init();
});
