{{ Form::open(array('url' => 'search')) }}
    <div class="input-group">
        {{ Form::text('search_text', null, array('class' => 'form-control', 'placeholder' => 'Find more recipes...')) }}
                    <span class="input-group-btn">
                        <input type="submit" value="Search" class="btn btn-primary" type="button" />Search
                    </span>
    </div><!-- /input-group -->
{{ Form::close() }}