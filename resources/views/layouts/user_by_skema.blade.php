<label for="user">Pilih User:</label>
<select id="user" name="user">
    @foreach ($users as $user)
        <option value="{{ $user->user->id_users }}">{{ $user->user->nama_lengkap }}</option>
    @endforeach
</select>
