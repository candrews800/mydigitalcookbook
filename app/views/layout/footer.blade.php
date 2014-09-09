<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <p class="text-left">
                © <a href="http://clintonandrews.com">Clinton Andrews</a> {{ date("Y") }} -  <a href="{{ url('') }} ">MyDigitalCookbook.com</a>.
            </p>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{ url('js/bootstrap.min.js') }} "></script>
<script src="{{ url('js/tablesorter.min.js') }} "></script>
</body>
</html>
<script>
    <?php
        $session = Session::all();
    ?>
    @if(isset($session['login_error']))
        $('#signIn').modal('show');
    @endif
</script>