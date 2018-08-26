<footer class="footer uoo">
    <div class="container">
        <img src="<?php echo URL; ?>img/footerr.png" style="margin-left: -18.5%;margin-top: 32%;">
    </div>
</footer>
    <!-- jQuery, loaded in the recommended protocol-less way -->
    <!-- <script src="<?php echo URL; ?>js/jquery.min.js"></script> -->
    <script src="<?php echo URL; ?>js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo URL; ?>js/md5.js"></script>

    <!-- define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
    <script>
        // var url = "<?php echo URL; ?>";
        // window.onscroll = function() {myFunction()};

        // var header = document.getElementById("myHeader");
        // var sticky = header.offsetTop;

        // function myFunction() {
        //   if (window.pageYOffset >= sticky) {
        //     header.classList.add("sticky");
        //   } else {
        //     header.classList.remove("sticky");
        //   }
        // }
        $(window).scroll(function() {

            if ($(this).scrollTop()>0)
             {
                $('.upp').fadeOut();
             }
            else
             {
              $('.upp').fadeIn();
             }
         });
        (function() {
    $('.footer').css('position', $(document).height() > $(window).height() ? "inherit" : "fixed");
})();
    </script>
    <script type="text/javascript">
    references = [];
    function addReference() {
        var indRef = document.getElementById("references").selectedIndex;
        var value = document.getElementById("references").options[indRef].value;
        if (references.includes(value) == false && value != "") {
            references.push(value);
            document.getElementById("referencess").value = references;
            document.getElementById("ref").value = references;
            }
    }
    function subReference() {
        references = [];
        document.getElementById("referencess").value = references;
        document.getElementById("ref").value = references;
    }
    processus = [];
    function addProcessus() {
        var indProc = document.getElementById("processuss").selectedIndex;
        var value = document.getElementById("processuss").options[indProc].value;
        if (processus.includes(value) == false && value != "") {
            processus.push(value);
            document.getElementById("processus").value = processus;
            }
    }
    function subProcessus() {
        processus = [];
        document.getElementById("processus").value = processus;
    }
    auditeurs = [];
    function addAuditeur() {
        var indRef = document.getElementById("audits").selectedIndex;
        var value = document.getElementById("audits").options[indRef].value;
        if (auditeurs.includes(value) == false && value != "") {
            auditeurs.push(value);
            document.getElementById("auditeurss").value = auditeurs;
            document.getElementById("auditeurs").value = auditeurs;
            }
    }
    function subAuditeur() {
        auditeurs = [];
        document.getElementById("auditeurss").value = auditeurs;
        document.getElementById("auditeurs").value = auditeurs;
    }
    function updateTextInput(val) {
          document.getElementById('textInput').value=val+'%';
          document.getElementById('ic').value=val+'%'; 
        }
    </script>

    <!-- our JavaScript -->
    <!-- <script src="<?php echo URL; ?>js/application.js"></script> -->
    <script src="<?php echo URL; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo URL; ?>js/bootstrap.bundle.min.js"></script>
    <!-- <script src="<?php echo URL; ?>public/js/bootstraps.min.js"></script> -->
</body>
</html>
