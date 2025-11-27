@extends('layouts.admin')

@section('title', 'Reorder Skills')

@section('content')
<div class="card shadow">
  <div class="card-body">
    <form id="reorderForm" action="{{ route('admin.skills.updateOrder') }}" method="POST">
      @csrf
      <ul id="skillList" class="list-group mb-3">
        @foreach($skills as $skill)
          <li class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $skill->id }}">
            <span>
              <i class="fas fa-grip-vertical me-2 text-muted"></i>
              {{ $skill->name }} <small class="text-muted">({{ $skill->level }}%)</small>
            </span>
            <span>
              <button type="button" class="btn btn-sm btn-outline-secondary move-up"><i class="fas fa-arrow-up"></i></button>
              <button type="button" class="btn btn-sm btn-outline-secondary move-down"><i class="fas fa-arrow-down"></i></button>
            </span>
          </li>
        @endforeach
      </ul>
      <div class="d-flex justify-content-between">
        <a href="{{ route('admin.skills.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Save Order</button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const list = document.getElementById('skillList');

  function moveItem(item, direction) {
    if (direction === 'up' && item.previousElementSibling) {
      list.insertBefore(item, item.previousElementSibling);
    } else if (direction === 'down' && item.nextElementSibling) {
      list.insertBefore(item.nextElementSibling, item);
    }
  }

  list.addEventListener('click', function(e) {
    if (e.target.closest('.move-up')) {
      moveItem(e.target.closest('li'), 'up');
    }
    if (e.target.closest('.move-down')) {
      moveItem(e.target.closest('li'), 'down');
    }
  });

  document.getElementById('reorderForm').addEventListener('submit', function() {
    // remove existing order inputs
    document.querySelectorAll('input[name="order[]"]').forEach(el => el.remove());
    // append order[] inputs in current order
    Array.from(list.children).forEach((li) => {
      const input = document.createElement('input');
      input.type = 'hidden';
      input.name = 'order[]';
      input.value = li.getAttribute('data-id');
      this.appendChild(input);
    });
  });
});
</script>
@endsection
