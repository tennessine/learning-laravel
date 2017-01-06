@role('admin')
    <p>You're administrator</p>
@endrole

@permission('create-post')
	<p>You can create post</p>
@endpermission

@ability('admin,owner', 'create-post,edit-user')
    <p>You can create post or edit user</p>
@endability