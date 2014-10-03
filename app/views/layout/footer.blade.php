<footer>
    <div id="footer-divider"></div>
    <!-- Footer Links Menu -->
    <div class="row">
        <div id="footer-logo" class="col-xs-12 col-md-4 text-center">
            <img src="{{ url('img/logo.png') }}" />
        </div>
        <div id="footer-menu" class="col-xs-12 col-md-8 text-center">
            <ul class="clearfix">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/search') }}">All Recipes</a></li>
                <li><a href="{{ url('/cookbook') }}">My Cookbook</a></li>
                <li><a href="{{ url('/meal') }}">Meal Planner</a></li>
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
<script type="text/javascript" src="{{ url('js/jquery.mmenu.min.all.js') }}"></script>
</body>
</html>
<script>
    $(document).ready(function(){
            @if($errors->newRecipe->all())
                $('#new-recipe').modal('show');
            @endif

            @if($errors->editRecipe->all())
                $('#edit-recipe').modal('show');
            @endif

            $("#left-mobile").mmenu({});

            $("#right-mobile").mmenu({
                offCanvas: {
                    position  : "right",
                    zposition : "next"
                }
            });

        });
</script>