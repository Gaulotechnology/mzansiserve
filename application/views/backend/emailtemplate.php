<!DOCTYPE html>
<title>My Example</title>
<style>
body { 
  display: grid;
  grid-template-areas: 
    "header header header"
    "nav article ads"
    "footer footer footer";
  grid-template-rows: 60px 1fr 60px;
  grid-template-columns: 20% 1fr 15%;
  grid-gap: 10px;
  height: 100vh;
  margin: 0;
  }
/* Stack the layout on small devices/viewports. */
@media all and (max-width: 575px) {
  body { 
    grid-template-areas: 
      "header"
      "article"
      "ads"
      "nav"
      "footer";
    grid-template-rows: 80px 1fr 70px 1fr 70px;  
    grid-template-columns: 1fr;
 }
}
#pageHeader {
  grid-area: header;
}
#pageFooter {
  grid-area: footer;
}
#mainArticle { 
  grid-area: article;      
  }
#mainNav { 
  grid-area: nav; 
  }
#siteAds { 
  grid-area: ads; 
  }
header, footer, article, nav, div {
  padding: 20px;
  background: gold;
}
</style>
<body>
  <header id="pageHeader">Header</header>
  <article id="mainArticle">Article</article>
  <nav id="mainNav">Nav</nav>
  <div id="siteAds">Ads</div>
  <footer id="pageFooter">Footer</footer>
</body>