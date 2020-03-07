"use strict";!function(a){var b={Constants:{MEDIA_QUERY_BREAKPOINT:"992px"},CssClasses:{CONTACT_LIST:"contact-list",CONTACT_LIST_ITEM:"contact-list-item",CONTACT_LIST_LINK:"contact-list-link",CONTACT_CONTENT:"contact-content",ACTIVE:"active",HOVER:"hover"},init:function(){this.$window=a(window),this.$list=a("."+this.CssClasses.CONTACT_LIST),this.$items=a("."+this.CssClasses.CONTACT_LIST_ITEM),this.$links=a("."+this.CssClasses.CONTACT_LIST_LINK),this.$content=a("."+this.CssClasses.CONTACT_CONTENT),this.$backBtns=this.$content.find('[data-toggle="tab"]'),this.breakpoint=null,this.bindEvents()},bindEvents:function(){this.$items.on("mouseenter.e.contact",this.handleItemMouseEnter.bind(this)),this.$items.on("mouseleave.e.contact",this.handleItemMouseLeave.bind(this)),this.$links.on("click.e.contact",this.handleLinkClick.bind(this)),this.$links.add(this.$backBtns).on("shown.bs.tab",this.handleTabShown.bind(this)),this.breakpoint=window.matchMedia("(max-width: "+this.Constants.MEDIA_QUERY_BREAKPOINT+")"),this.breakpoint.addListener(this.handleMediaQueryChange.bind(this))},handleItemMouseEnter:function(b){a(b.currentTarget).addClass(this.CssClasses.HOVER)},handleItemMouseLeave:function(b){a(b.currentTarget).removeClass(this.CssClasses.HOVER)},handleLinkClick:function(b){var c=a(b.currentTarget),d=c.closest("."+this.CssClasses.CONTACT_LIST_ITEM);d.hasClass(this.CssClasses.ACTIVE)&&d.removeClass(this.CssClasses.ACTIVE),this.rememberScrollbarPos()},handleTabShown:function(b){var c=a(b.currentTarget),d=this.getActiveLink();c.is(d)?this.scrollTo(0):this.scrollTo(this.rememberedScrollbarPos())},handleMediaQueryChange:function(a){var b=this[this.mediaQueryMatches()?"getBackBtn":"getActiveLink"]();b.length&&b.trigger("click")},mediaQueryMatches:function(){return this.breakpoint.matches},rememberScrollbarPos:function(){this.ypos=this.$window.scrollTop()},rememberedScrollbarPos:function(){return this.ypos},getActiveItem:function(){return this.$items.filter("."+this.CssClasses.ACTIVE)},getActiveContact:function(){return this.$content.filter("."+this.CssClasses.ACTIVE)},getActiveLink:function(){var a=this.getActiveItem();return a.find('[data-toggle="tab"]')},getBackBtn:function(){var a=this.getActiveContact();return a.find('[data-toggle="tab"]')},scrollTo:function(a){this.$window.scrollTop(a)}};b.init()}(jQuery);