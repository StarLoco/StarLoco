/*********************************************************************
  #### Twitter Post Fetcher v5.0 ####
  Coded by Jason Mayes 2013. A present to all the developers out there.
  www.jasonmayes.com
*********************************************************************/
var twitterFetcher=function() {function p(d){return d.replace(/<b[^>]*>(.*?)<\/b>/gi,function(b,d){return d}).replace(/class=".*?"|data-query-source=".*?"|dir=".*?"|rel=".*?"/gi,"")}var q="",l=20,m=!0,g=[],n=!1,j=!0,k=!0;return{fetch:function(d,b,e,h,f,c){void 0===e&&(e=20);void 0===h&&(m=!0);void 0===f&&(f=!0);void 0===c&&(c=!0);n?g.push({id:d,domId:b,maxTweets:e,enableLinks:h,showUser:f,showTime:c}):(n=!0,q=b,l=e,m=h,k=f,j=c,b=document.createElement("script"),b.type="text/javascript",b.src="http://cdn.syndication.twimg.com/widgets/timelines/"+
d+"?&lang=en&callback=twitterFetcher.callback&suppress_response_codes=true&rnd="+Math.random(),document.getElementsByTagName("head")[0].appendChild(b))},callback:function(d){var b=document.createElement("div");b.innerHTML=d.body;d=b.getElementsByClassName("e-entry-title");for(var e=b.getElementsByClassName("p-author"),h=b.getElementsByClassName("dt-updated"),b=[],f=d.length,c=0;c<f;){if(m){var a="";k&&(a+='<div class="user">'+p(e[c].innerHTML)+"</div>");a+='<p class="tweet">'+p(d[c].innerHTML)+"</p>";
j&&(a+='<p class="timePosted">'+h[c].getAttribute("aria-label")+"</p>")}else d[c].innerText?(a="",k&&(a+='<p class="user">'+e[c].innerText+"</p>"),a+='<p class="tweet">'+d[c].innerText+"</p>",j&&(a+='<p class="timePosted">'+h[c].innerText+"</p>")):(a="",k&&(a+='<p class="user">'+e[c].textContent+"</p>"),a+='<p class="tweet">'+d[c].textContent+"</p>",j&&(a+='<p class="timePosted">'+h[c].textContent+"</p>"));b.push(a);c++}b.length>l&&b.splice(l);d=b.length;e=0;h=document.getElementById(q);for(f="<ul>";e<
d;)f+="<li>"+b[e]+"</li>",e++;h.innerHTML=f+"</ul>";n=!1;0<g.length&&(twitterFetcher.fetch(g[0].id,g[0].domId,g[0].maxTweets,g[0].enableLinks,g[0].showUser,g[0].showTime),g.splice(0,1))}}}();

/*
* ### HOW TO CREATE A VALID ID TO USE: ###
* Go to www.twitter.com and sign in as normal, go to your settings page.
* Go to "Widgets" on the left hand side.
* Create a new widget for what you need eg "user timeline" or "search" etc. 
* Feel free to check "exclude replies" if you dont want replies in results.
* Now go back to settings page, and then go back to widgets page, you should
* see the widget you just created. Click edit.
* Now look at the URL in your web browser, you will see a long number like this:
* 345735908357048478
* Use this as your ID below instead!
*/

/**
 * How to use fetch function:
 * @param {string} id Your Twitter widget ID.
 * @param {string} domId The ID of the DOM element you want to write results to. 
 * @param {int} maxNumberOfTweets Optional - the maximum number of tweets you
 *     want returned. Must be a number between 1 and 20.
 * @param {boolean} parseLinks Optional - set true if you want urls and hash
       tags to be hyperlinked!
 * @param {boolean} showUser Optional - Set false if you dont want user photo /
 *     name for tweet to show.
 * @param {boolean} showTime Optional - Set false if you dont want time of tweet
 *     to show.
 */

// Latest tweet
twitterFetcher.fetch('657197335030689792', 'twitter', 1, true, false);