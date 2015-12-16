var viewport = document.getElementById('meta_viewport');
if (navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPod/i)) {
  viewport.setAttribute("content", "width=640, initial-scale=0.5, maximum-scale=1, minimum-scale=0.50, user-scalable=yes");
} else if (navigator.userAgent.match(/iPad/i)) {
  viewport.setAttribute("content", "width=960, initial-scale=0.8, user-scalable=yes");
}
(function ($) {
  /**
   * Task to do when document is ready (all loaded).
   */
  $(document).ready(function () {
    //
    //  copy call to action buttons to the top of the main region (visible only on mobiles)
    //
    var call2actions = $('#block-block-4 .block-inner');
    if (call2actions.size()) {
      $('#block-system-main>.block-inner>.content').prepend(call2actions.clone());
    }

    $('#region-branding .region-inner').append('<div id="menu_appended"><div class="wrapper" /></div>');
    $('#region-branding .region-inner').find('#block-menu-block-4').appendTo('#menu_appended .wrapper');
    $('li.menu-mlid-1190 a').attr('target', '_blank');

    //
    //  fix menu at the top of the window when scrolling
    //
    $(window).scroll(function () {
      if ($('body').hasClass('responsive-layout-normal')) {
        var st = $(window).scrollTop();
        //$('#menu_appended, #block-menu-block-1 .menu-block-1>ul.menu>li').trigger('mouseleave');
        if (st > 129) {
          $('#section-header').addClass('fixed_position').find('#zone-menu-wrapper').css({top: st});
          $('#menu_appended').css({top: st - 4});
        } else {
          $('#section-header').removeClass('fixed_position').find('#zone-menu-wrapper').css({top: 'auto'});
          $('#menu_appended').css({top: 125});
        }
      } else {
        $('#section-header').removeClass('fixed_position').find('#zone-menu-wrapper').css({top: 'auto'});
        $('#menu_appended').css({top: 125});
      }
    });

    if ($('.block-banners-block, .block-banners-block-1').size()) {
      var _current = $('.block-banners-block, .block-banners-block-1').find('.views-row:first .banner');
      $('#zone-menu-wrapper').append('<div id="main_top_banners" style="background-image:url(' + _current.data('url') + ');">' +
        '<div class="mask first"><span class="triangle" /></div>' +
        '<div class="mask last"><span class="triangle" /></div>' +
        '</div>');
      $('.block-banners-block, .block-banners-block-1').find('.view').slides({
        next: 'banner_next',
        prev: 'banner_prev',
        paginationClass: 'banner_pagination',
        effect: 'fade',
        generatePagination: true,
        generateNextPrev: true,
        container: 'view-content',
        animationComplete: function (current) {
          var _current = $('.block-banners-block, .block-banners-block-1').find('.views-row:eq(' + (current - 1) + ') .banner');
          $('#main_top_banners').css({backgroundImage: 'url(' + _current.data('url') + ')'});
        }
      });
    }

    $('#menu_appended').bind('mouseenter', function () {
      $(this).addClass('hover');
    }).bind('mouseleave', function () {
      $(this).removeClass('hover');
    });

    $('#block-menu-block-1 .menu-block-wrapper>ul.menu, #block-menu-block-1 .menu-block-wrapper .view-content').addClass('clearfix');

    $('#block-menu-block-1 .menu-block-1>ul.menu>li').bind('touchstart', function () {
      if (!$(this).find('a.mobile_added').size()) {
        var _a  = $(this).find('>a').clone();
        _a.addClass('mobile_added');
        _a.html('Lehrg&#228;nge');
        var _li = $('<li />');
        _li.append(_a);
        $(this).find('>ul>li:eq(1)>ul').prepend(_li);
      }
      if ($('body').hasClass('responsive-layout-mobile')) {
        window.location = $(this).find('>a').attr('href');
        return false;
      }
    });

    if (isIE7()) {
      var zIndexNumber = 500;
      $('div').each(function () {
        $(this).css('zIndex', zIndexNumber);
        zIndexNumber -= 5;
      });
    }
  });

  /**
   * Main menu animation.
   */
  Drupal.behaviors.menu_animation = {
    attach: function (context) {
      // add event handler to top menus once
      $('#block-menu-block-1 .menu-block-1>ul.menu>li', context).once('menu-animation', function () {

        // define column creation and reordering function
        function reorderColumns(column) {
          // only reorder menu-views column in normal layout
          var _isNormalLayout = $('body').hasClass('responsive-layout-normal');
          if (column.hasClass('menu-views') && _isNormalLayout) {
            var _viewCourses = column.find('.view-courses');
            var _ulsColumn2  = _viewCourses.find('.view-content ul.menu-view-column-2');
            if (_ulsColumn2.length > 0) {
              // second column for menus view needed, create it with all second column ul's in it
              column.addClass('double');
              column.parent().addClass('double');
              _ulsColumn2.detach().appendTo(_viewCourses).wrapAll('<div class="view-content-right clearfix"></div>');

              // third column for menus view needed?
              var _ulsColumn3 = _viewCourses.find('.view-content ul.menu-view-column-3');
              if (_ulsColumn3.length > 0) {
                // move content of second column to third column, then fill emptied (second) column
                var _sColumns = column.siblings();
                var _sColumn1 = _sColumns.first();
                _sColumn1.children().detach().prependTo(_sColumns.last());
                _ulsColumn3.detach().appendTo(_sColumn1).wrapAll('<div class="view-content-right clearfix"></div>');
              }
            }
          }
        }

        // clone menu block for reset on mouseleave event
        var menuBlockClone;

        // bind top menus to mouseenter and mouseleave events
        $(this).mouseenter(function () {
          var menu       = $(this);
          var menuBlock  = menu.find(">ul.menu");
          menuBlockClone = menuBlock.clone();

          // make equal heights for all visible menu columns
          // CAUTION! menu block has to be displayed (outside screen) to have height != 0
          var _h       = 0;
          var _columns = menuBlock.find('>li');
          menuBlock.css({"margin-top": -9999, "display": "block"});
          _columns.css({height: 'auto'}).each(function () {
            // create sub-columns in menu and reorder them, if needed
            reorderColumns($(this));

            // calculate the max. height of all columns
            if ($(this).is(':visible')) {
              var _hh = $(this).height();
              _h      = _h < _hh ? _hh : _h;
            }
          });

          // columns are reordered and height calculated, set "touch_hover"
          _columns.height(_h);
          menuBlock.css({"margin-top": 0, "display": "none"});
          menu.addClass("touch_hover");

          setTimeout(function () {
            // only slide down after timeout when still hovered
            if (menu.hasClass("touch_hover")) {
              menuBlock.slideDown("fast");
            }
          }, 300);

        }).mouseleave(function () {
          var menu      = $(this);
          var menuBlock = menu.find(">ul.menu");
          menu.removeClass("touch_hover");
          menuBlock.fadeOut("slow");

          // reset menu block (columns)
          menuBlock.replaceWith(menuBlockClone);
        });
      });
    }
  };

  Drupal.behaviors.teaser_tabs      = {
    attach: function (context) {
      $('.views-field-field-teaser-tabs .item-list>ul', context).once(function () {
        var _childs = $(this).addClass('scrollable clearfix').find('>li');
        var links_t = $('<div class="teasertabs_links header" data-current="-1" data-total="' + _childs.size() + '"><a href="#" class="previous" /><span class="divider">&nbsp;</span><a href="#" class="next" /></div>');
        var links_b = $('<div class="teasertabs_links footer" data-current="-1" data-total="' + _childs.size() + '"><a href="#" class="previous" /><span class="divider">&nbsp;</span><a href="#" class="next" /></div>');
        $(this).parent().prepend(links_t);
        $(this).parent().append(links_b);
        $(this).parent().find('.teasertabs_links a').click(function () {
          var _s       = $(this);
          var _links   = _s.parent().parent().find('.teasertabs_links');
          var _il      = _links.siblings('ul');
          var _current = _links.data('current');
          var _total   = _links.data('total');
          if (_current > -1) {
            var _li = _il.find('>li');
            var _w  = _li.outerWidth();
            if (_s.hasClass('previous')) {
              _li.parent().animate({left: '+=' + _w}, 0);
            } else {
              _li.parent().animate({left: '-=' + _w}, 0);
            }
          }
          if (_s.hasClass('previous')) {
            _current--;
          } else {
            _current++;
          }
          if (_current >= _total - 1 && _current <= 0) {
            _links.hide();
            $(this).closest('.item-list').css({paddingBottom: 0});
          } else {
            _links.show().find('.divider').show();
            if (_current > 0) {
              _links.find('a.previous').html(_il.find('>li:eq(' + (_current - 1) + ') h2.teaser_title').html()).show();
            } else {
              _links.find('a.previous, .divider').hide();
            }
            if (_current < _total - 1) {
              _links.find('a.next').html(_il.find('>li:eq(' + (_current + 1) + ') h2.teaser_title').html()).show();
            } else {
              _links.find('a.next, .divider').hide();
            }
            _links.data('current', _current);
          }
          return false;
        }).filter('.next:first').click();
      });
    }
  };

  Drupal.behaviors.teaser_make_tabs = {
    attach: function (context) {
      $('.view.view-course-intros, .view.view-course-tabs', context).once(function () {
        $(this).find('.view-content:first').tabs({
          select: function (event, ui) {
            var _selected = ui.index;
            // Check if it's visible
            var _widthAcumulated     = 0;
            var _prevWidthAcumulated = 0;
            var _nav                 = $(event.target).find('.ui-tabs-nav');
            var _w                   = _nav.parent().width();
            _nav.find('li').each(function (i, ele) {
              _widthAcumulated += $(this).outerWidth();
              if (i == _selected) {
                return false;
              }
              _prevWidthAcumulated += $(this).outerWidth();
            });
            var _currentLeft         = parseInt(_nav.css('left'), 10);
            if (_w - _currentLeft < _widthAcumulated) {
              _nav.css({left: _w - _widthAcumulated});
            } else if (_currentLeft * (-1) > _prevWidthAcumulated) {
              _nav.css({left: _prevWidthAcumulated * (-1)});
            }
            window.location.hash = ui.tab.hash;
          }
        });
        $(this).find('.view-content:first').append('<a href="#" class="tab_pager previous" /><a href="#" class="tab_pager next" />');
        $(this).find('.view-content .ui-tabs-nav').wrap('<div class="tab_scroll" />');
        $(this).find('.view-content a.tab_pager').click(function () {
          var _p      = $(this).parent();
          var _active = _p.tabs('option', 'selected');
          var _totals = _p.tabs('length');
          if ($(this).hasClass('next')) {
            if (_active < _totals - 1) {
              _p.tabs('select', _active + 1);
            }
          } else {
            if (_active > 0) {
              _p.tabs('select', _active - 1);
            }
          }
          return false;
        });
      });
    }
  };
  Drupal.behaviors.hso_titles       = {
    attach: function (context) {
      $('#block-block-1, #block-views-hso-tv-block', context).find('h2.block-title').once(function () {
        $(this).html($(this).html().replace(/^HSO/, '<strong>HSO</strong>'));
      });
    }
  };

  Drupal.behaviors.witercho_links = {
    attach: function (context) {
      $('.node.node-segment-blocks:has(.witercho_links)', context).addClass('wrapper-links-witercho');
      $('.node.node-segment-blocks:has(.lehrgang_links)', context).addClass('wrapper_lehrgang_links');
    }
  };

  Drupal.behaviors.centers_links = {
    attach: function (context) {
      $('.pane-views-panes.pane-centers-panel-pane-1 .item-list ul li.views-row:has(a.active)').addClass('active');
    }
  };

  Drupal.behaviors.block_with_header_links = {
    attach: function (context) {
      $('.block-fachwissen-block, .block-views-contacts-block-segment-contacts, ' +
        '.block-views-contacts-block-course-contacts, #block-views-locations-block', context).once(function () {
        var _header = $('<ul class="header_links" />');
        $(this).find('.view .item-list>h3').each(function (i, e) {
          var _s = $(this);
          var _l = $('<li />').html('<a href="#" data-i="' + i + '">' + _s.html() + '</a>');
          _header.append(_l);
          _s.remove();
        });
        $(this).find('.view').prepend(_header);
        $(this).find('.header_links a').click(function () {
          $(this).closest('ul').find('a').removeClass('active');
          $(this).addClass('active').closest('.view').find('.item-list').hide().filter(':eq(' + $(this).data('i') + ')').show();
          return false;
        }).filter(':first').click();
      });
    }
  };

  Drupal.behaviors.menu_arrows = {
    attach: function (context) {
      $('.pane-blog-panel-pane-1 .pane-title, .pane-blog-panel-pane-2 .pane-title, .pane-videos-panel-pane-1 .pane-title,.menu-block-1>ul>li>a, #region-footer-first h2.block-title', context).once(function () {
        $(this).append('<span class="arrow" />');
      });
    }
  };

  Drupal.behaviors.anmelden_button = {
    attach: function (context) {
      $('a.anmelden_button', context).once(function () {
        $(this).click(function () {
          var _v = $('.view.view-course-tabs .view-content:first');
          _v.tabs('select', _v.tabs('length') - 1);
        });
      });
    }
  };

  Drupal.behaviors.unsere_dozenten = {
    attach: function (context) {
      $('.panel-pane.pane-logos-panel-pane-1 .view-content').prepend('<a class="browse prev" />');
      $('.panel-pane.pane-logos-panel-pane-1 .view-content').append('<a class="browse next" />');
      $('.panel-pane.pane-logos-panel-pane-1 .view-content .item-list').scrollable({
        items: 'ul',
        circular: true
      });
      $('.pane-team-panel-pane-1').once(function () {
        $(this).find('.pane-content').prepend('<a class="browse prev" />').append('<a class="browse next" />').find('.view').scrollable({
          items: '.view-content',
          circular: $(this).find('.views-row').size() > 5
        });
      });
    }
  };

  Drupal.behaviors.twitter_box = {
    attach: function (context) {
      $('.twitter_box', context).once(function () {
        var _tw_box   = $(this);
        var _username = _tw_box.data('username');
        var url       = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//api.twitter.com/1/statuses/user_timeline.json?screen_name=' + _username + '&count=1&callback=?';
        $.ajax({
          url: url,
          dataType: 'json',
          success: function (tweets) {
            $.each(tweets, function (i, post) {
              _tw_box.html($([post.text]).linkUrl().linkUser().linkHash()[0]);
            });
            if (twttr && twttr.widgets) {
              twttr.widgets.load();
            }
          }
        });
      });
    }
  };

  Drupal.behaviors.blog_blocks = {
    attach: function (context) {
      $('#mini-panel-home_blog, #mini-panel-segment_blog', context).once(function () {
        var _pane = $(this).find('>.panel-panel');
        _pane.prepend('<div class="header"></div>');
        $(this).find('.pane-title').each(function (i, e) {
          var _s = $(this);
          var _l = $('<a href="#" class="pane-title" data-i="' + i + '">' + _s.html() + '<span class="arrow" /></a>');
          if (i == 0) {
            _l.addClass('first');
          }
          _pane.find('.header').append(_l);
          _s.remove();
        });
        $(this).find('a.pane-title').click(function () {
          var _pane = $(this).closest('.panel-panel');
          _pane.find('.header a.pane-title').removeClass('active');
          $(this).addClass('active');
          _pane.find('.panel-pane').hide().filter(':eq(' + $(this).data('i') + ')').show();
          return false;
        }).filter(':first').click();
      });
    }
  };

  Drupal.behaviors.testimonials = {
    attach: function (context) {
      $('.node.node-testimonial', context).once(function () {
        $(this).hover(
          function () {
            $(this).find('div.front, div.back').stop().rotate3Di('flip', 250, {
              direction: 'clockwise', sideChange: function () {
                $(this).parent().find('div.front').hide();
                $(this).parent().find('div.back').show();
              }
            });
          },
          function () {
            $(this).find('div.front, div.back').stop().rotate3Di('unflip', 250, {
              direction: 'clockwise', sideChange: function () {
                $(this).parent().find('div.back').hide();
                $(this).parent().find('div.front').show();
              }
            });
          });
      });
    }
  };

  Drupal.behaviors.hso_tv_block = {
    attach: function (context) {
      $('#block-views-hso-tv-block', context).once(function () {
        var _header = $('<ul class="header_links" />');
        $(this).find('.view .item-list>h3').each(function (i, e) {
          var _s = $(this);
          var _l = $('<li />').html('<a href="#" data-i="' + i + '">' + _s.html() + '</a>');
          _header.append(_l);
          _s.remove();
        });
        $(this).find('.view').prepend(_header);
        $(this).find('.view-content>.item-list>ul').addClass('slides_container').each(function (i, ele) {
          $(ele).parent()
            .append('<a class="browse prev browse_prev_' + i + '" href="javascript:void(0);">&lt;</a>')
            .append('<a class="browse next browse_next_' + i + '" href="javascript:void(0);">&gt;</a>')
            .slides({
              generatePagination: false,
              next: 'browse_next_' + i,
              prev: 'browse_prev_' + i
            });
        });
        $(this).find('.header_links a').click(function () {
          $(this).closest('ul').find('a').removeClass('active');
          $(this).addClass('active').closest('.view').find('.item-list').hide().filter(':eq(' + $(this).data('i') + ')').show();
          return false;
        }).filter(':first').click();
      });
    }
  };

  Drupal.behaviors.ecdl_anmeldung = {
    attach: function (context) {
      $('#webform-client-form-476', context).once(function () {
        var checkCount = function () {
          var _f            = $('#webform-client-form-476');
          var total_modules = _f.find('#webform-component-module input:checkbox:checked').add('#webform-component-module-base input:checkbox:checked').size();
          if (total_modules > 2) {
            alert("Information\n_______________________________________________________\n\nPro Pr\u00FCfungstermin k\u00F6nnen Sie maximal zwei Module absolvieren.\n\nBitte melden Sie sich f\u00FCr weitere Module an einem\nanderen Tag an!");
            return false;
          }
          _f.find('#webform-component-agbcheck label strong').html('CHF ' + (total_modules * 65) + '.--');
        };
        $(this).find('#webform-component-module input:checkbox').add('#webform-component-module-base input:checkbox').click(checkCount);
        checkCount();
      });
    }
  };

  Drupal.behaviors.dynamicSelectBoxes = {
    attach: function () {
      var $webform         = $('form#webform-client-form-1336'),
          $selectInteresse = $webform.find('#edit-submitted-interesse'),
          $compAbschluss   = $webform.find('#webform-component-abschluss'),
          $selectAbschluss = $webform.find('#edit-submitted-abschluss'),
          $compLehrgang    = $webform.find('#webform-component-lehrgang'),
          $selectLehrgang  = $webform.find('#edit-submitted-lehrgang');

      // hide select boxes and reset interesse select box
      $compAbschluss.hide();
      $compLehrgang.hide();
      $selectInteresse.val(-1);

      $selectInteresse.once('change', function () {
        $(this).change(function () {
          var tid = $selectInteresse.find('option:selected').val();

          $selectAbschluss.html('<option>Auswahl wird geladen...</option>');
          $compAbschluss.show(300);
          $compLehrgang.hide();
          $selectAbschluss.load(Drupal.settings.basePath + 'get_graduations/' + tid, function (response, status, xhr) {
            if (status == "error") {
              $selectAbschluss.html("Keine Daten gefunden");
            }
          });

        });
      });
      $selectAbschluss.once('change', function () {
        $(this).change(function () {
          var tid  = $selectInteresse.find('option:selected').val(),
              tid2 = $selectAbschluss.find('option:selected').val();

          $selectLehrgang.html('<option>Lehrgänge werden geladen...</option>');
          $compLehrgang.show(300);
          $selectLehrgang.load(Drupal.settings.basePath + 'get_courses/' + tid + '/' + tid2, function (response, status, xhr) {
            if (status == "error") {
              $selectLehrgang.html("Keine Daten gefunden");
            }
          });

        });
      });
    }
  };

  $.fn.extend({
    linkUrl: function () {
      var returning = [];
      var regexp    = /((ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?)/gi;
      this.each(function () {
        returning.push(this.replace(regexp, "<a target=\"_blank\" href=\"$1\">$1</a>"));
      });
      return $(returning);
    },
    linkUser: function () {
      var returning = [];
      var regexp    = /[\@]+([A-Za-z0-9-_]+)/gi;
      this.each(function () {
        returning.push(this.replace(regexp, "<a href=\"https://twitter.com/intent/user?screen_name=$1\">@$1</a>"));
      });
      return $(returning);
    },
    linkHash: function (username) {
      var returning = [];
      var regexp    = /(?:^| )[\#]+([A-Za-z0-9-_]+)/gi;
      this.each(function () {
        returning.push(this.replace(regexp, ' <a target="_blank" href="http://search.twitter.com/search?q=&tag=$1&lang=all">#$1</a>'));
      });
      return $(returning);
    },
    makeHeart: function () {
      var returning = [];
      this.each(function () {
        returning.push(this.replace(/(&lt;)+[3]/gi, "<tt class='heart'>&#x2665;</tt>"));
      });
      return $(returning);
    }
  });
})(jQuery);
var isIE8    = function () {
  return !!( (/msie 8./i).test(navigator.appVersion) && !(/opera/i).test(navigator.userAgent) && window.ActiveXObject && XDomainRequest && !window.msPerformance );
}
var isIE7    = function () {
  return ((document.all) && (navigator.appVersion.indexOf("MSIE 7.") != -1));
}
