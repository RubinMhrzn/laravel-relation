@if (auth('admin')->check())
    <h2>Admin Dashboard</h2>
    <table class="table-auto border-collapse border border-gray-400">
        <tr>
            <th class="border border-gray-400 px-4 py-2">Name</th>
            <td class="border border-gray-400 px-4 py-2">{{ auth('admin')->user()->name }}</td>
        </tr>
        <tr>
            <th class="border border-gray-400 px-4 py-2">Email</th>
            <td class="border border-gray-400 px-4 py-2">{{ auth('admin')->user()->email }}</td>
        </tr>
        <tr>
            <th class="border border-gray-400 px-4 py-2">Joined</th>
            <td class="border border-gray-400 px-4 py-2">{{ auth('admin')->user()->created_at->format('d M, Y') }}</td>
        </tr>
    </table>
@endif
<form action="{{ route('admin.logout') }}" method="post">
    @csrf
    @method('post')
    <button value="submit">logout</button>
</form>
