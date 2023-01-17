@push('after-styles')
    <style>
        #add-matrix {
            background: {{$lesson->color1}} !important;
            color: white;
        }

        #symbol_matrix_value th {
            text-align: center;
        }

        .table-striped > tbody > tr:nth-of-type(2n) {
            background-color: {{$lesson->color2}} !important;
        }
    </style>
@endpush

<?php echo html_entity_decode($question->content);?>