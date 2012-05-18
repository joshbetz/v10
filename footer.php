  <footer>
    <span class="copyright">&copy; <?php echo date('Y', time())?> Josh Betz.</span>
    <span class="powered-by">Proudly powered by <a href="http://wordpress.org">WordPress</a> & <a href="http://www.rackspacecloud.com/2670.html">Rackspace</a></span>
  </footer>
</div>

  <?php wp_footer(); ?>
  
  <!-- JavaScript in Footer -->
  <script src="/js/prettify/prettify.js"></script>
  <script src="/js/jquery.fitvids.js"></script>

  <script>
    function styleCode() 
    {
        if (typeof disableStyleCode != "undefined") 
        {
            return;
        }

        var a = false;

        $("pre code").parent().each(function() 
        {
            if (!$(this).hasClass("prettyprint")) 
            {
                $(this).addClass("prettyprint").addClass("linenums");
                a = true
            }
        });
    
        if (a) { prettyPrint() } 
    }
  
    $(function() {
      //prettyify
      styleCode();

      //fitVids
      $("article").fitVids({customSelector: "iframe[src^='//speakerdeck.com']"});
    });
  </script>

</body>
</html>