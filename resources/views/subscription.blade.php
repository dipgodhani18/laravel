@extends('layouts.layout')

@section('content')
<!-- Subscription Plan -->
<div class="h-[calc(100vh-136px)] mt-[68px]">
    <div class="container mx-auto p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
            @foreach($plans as $plan)
            <div class="bg-gray-200 px-2 py-4">
                <h3 class="text-xl text-blue-800 font-semibold text-center">{{$plan->name}}</h3>
                <div class="text-center">
                    <span class="font-semibold">$ {{$plan->plan_amount}}.00</span>
                </div>
                <div class="text-center mt-4">
                    <button class="p-2 bg-blue-700 text-white text-sm font-medium rounded confirmationBtn"
                        data-id="{{$plan->id}}" onclick="openModal('confirmationModal', this)">
                        Subscribe
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


<!-- Modal -->
<div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-11/12 max-w-md">
        <div class="flex justify-between items-center border-b p-4">
            <h3 class="text-xl font-semibold text-green-700" id="modelTitle">Confirm Subscription</h3>
            <button onclick="closeModal('confirmationModal')"
                class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        <div class="p-4">
            <div class="confirmation-data">
                <p>loading...</p>
            </div>

        </div>
        <div class="flex justify-end space-x-3 border-t p-4">
            <button onclick="closeModal('confirmationModal')"
                class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                Cancel
            </button>
            <form method="POST" id="subscribeForm">
                @csrf
                <input type="hidden" name="plan_id" id="planIdInput">
                <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">
                    Confirm
                </button>
            </form>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
        document.getElementById(modalId).classList.add('flex');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
        document.getElementById(modalId).classList.remove('flex');
    }
</script>

<script>
    $(document).ready(function() {
        $('#modelTitle').text('...');
        $('.confirmation-data').html(`<p class='text-center'>loading...</p>`);

        $(".confirmationBtn").click(function() {
            let planId = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "{{route('getPlanDetails')}}",
                data: {
                    id: planId,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        let data = response.data;
                        let html = ``;
                        $('#modelTitle').text(data.name + ' ($' + data.plan_amount + ')');
                        html += `<p>` + response.msg + `</p>`
                        $('.confirmation-data').html(html);

                    } else {
                        alert("Something went wrong!")
                    }
                }
            })
        })


    });
</script>
@endpush