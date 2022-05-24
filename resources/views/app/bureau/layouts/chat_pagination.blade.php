              <div aria-label="Page navigation example">

                @if($paginator->lastPage() > 1)
                  <div class="pagination pagination-primary  justify-content-end" style="transform: rotate(180deg);
     writing-mode: vertical-lr;text-align: center;">
                      <span class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                          <a class="page-link"  href="{{ $paginator->url($paginator->currentPage()+1) }}" ><</a>
                      </span>
                      <span class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
                          <a class="page-link" href="{{ $paginator->url(1) }}" tabindex="-1" aria-disabled="true">></a>
                      </span>
                   
                    
                  </div>
                @endif

              </div>