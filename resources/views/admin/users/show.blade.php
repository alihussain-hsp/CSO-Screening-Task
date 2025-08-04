<div class="modal-body">
    <div>
        <table>
            <tr>
                <th>Name</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Created At</th>
                <td>{{ $user->created_at }}</td>
            </tr>
            <tr>
                <th>Updated At</th>
                <td>{{ $user->updated_at }}</td>
            </tr>
        </table>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
