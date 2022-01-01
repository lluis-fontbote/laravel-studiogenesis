<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Eliminar categoría</h5>
        </div>
        <div class="modal-body">
          <p>Si eliminas esta categoría sus categorías hijas podrían quedar huérfanas. ¿Estás seguro de ello?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="hideModal">Cancelar</button>
          <a href="" id="confirmDeletion"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sí, eliminar categoría</button></a>
          <a href="" id="deleteRecursively"><button class="btn btn-primary" id="botoComencar">Sí, y elimina  también las categorías huérfanas</button></a>
        </div>
      </div>
    </div>
</div>