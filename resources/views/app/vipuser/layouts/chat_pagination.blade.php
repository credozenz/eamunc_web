<div aria-label="Page navigation example">

@if($paginator->lastPage() > 1)
  <div class="pagination pagination-primary  justify-content-end" style="text-align: center;place-content: space-between !important;">
      <span class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
          <a class="page-link" href="{{ $paginator->url($paginator->currentPage()-1) }}" tabindex="-1" aria-disabled="true">< Back </a>
      </span>
   
    
      <span class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
          <a class="page-link"  href="{{ $paginator->url($paginator->currentPage()+1) }}" > Previous ></a>
      </span>
     
  </div>
@endif

</div>
<br>