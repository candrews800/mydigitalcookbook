<?php $page = 'admin'; ?>

@include('layout.header_new')

<div class="row">
    <div class="col-sm-12">
        <h1>
            Users
        </h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td><a href="{{ url('admin/users/'.$user->id) }}">{{ $user->username }}</a></td>
                        <td><a href="{{ url('admin/users/'.$user->id) }}">{{ $user->email }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p>
            <?php echo $users->links(); ?>
        </p>
    </div>
</div>

@include('layout.footer_new')