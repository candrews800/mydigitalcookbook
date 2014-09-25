<footer>
    <div id="footer-divider"></div>
    <!-- Footer Links Menu -->
    <div id="footer-menu" class="row">
        <div class="col-xs-12 col-md-4">
            <img id="#main-logo" src="{{ url('img/logo.png') }}" />
        </div>
        <div class="col-xs-12 col-md-4">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">MyCookbook</a></li>
                <li><a href="#">Meal Planner</a></li>
            </ul>
        </div>

    </div>

    <!-- Legal + Misc -->
    <hr />
    <div class="row">
        <div class="col-xs-12">
            <p id="legal-misc">
            Copyright 2014. MyDigitalCookbook.com

                <em>v0.1</em>
            </p>
        </div>
    </div>
</footer>



</div><!-- container class -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{ url('js/bootstrap.min.js') }} "></script>
<script src="{{ url('js/tablesorter.min.js') }} "></script>
</body>
</html>
<script>
    $(document).ready(function(){
            @if($errors->register->all())
                $('#register').modal('show');
            @endif

            @if($errors->newRecipe->all())
                $('#new-recipe').modal('show');
            @endif

            @if($errors->editRecipe->all())
                $('#edit-recipe').modal('show');
            @endif

        });
</script>