<?php 
class UsuariosController extends AppController{
	public $helpers = array('Html', 'Form', 'Flash');
    public $components = array('Flash');
	
	public function index() {
        $this->set('usuarios', $this->Usuario->find('all'));
    }
	
	 public function view($idUsuario = null) {
        if (!$idUsuario) {
            throw new NotFoundException(__('Invalid usuario'));
        }

        $usuario = $this->Usuario->findById($idUsuario);
        if (!$usuario) {
            throw new NotFoundException(__('Invalid usuario'));
        }
        $this->set('usuario', $usuario);
    }
	 public function add() {
        if ($this->request->is('usuario')) {
            $this->Usuario->create();
            if ($this->Usuario->save($this->request->data)) {
                $this->Flash->success(__('Your usuario has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your usuario.'));
        }
    }
	
	public function edit($idUsuario = null) {
		if (!$idUsuario) {
			throw new NotFoundException(__('Invalid usuario'));
		}

		$usuario = $this->Usuario->findById($idUsuario);
		if (!$usuario) {
			throw new NotFoundException(__('Invalid usuario'));
		}

		if ($this->request->is(array('usuario', 'put'))) {
			$this->Usuario->idUsuario = $idUsuario;
			if ($this->Usuario->save($this->request->data)) {
				$this->Flash->success(__('Your post has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(__('Unable to update your post.'));
		}

		if (!$this->request->data) {
			$this->request->data = $usuario;
		}
	}
	public function delete($idUsuario) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Usuario->delete($idUsuario)) {
			$this->Flash->success(
				__('The post with id: %s has been deleted.', h($idUsuario))
			);
		} else {
			$this->Flash->error(
				__('The post with id: %s could not be deleted.', h($idUsuario))
			);
		}

		return $this->redirect(array('action' => 'index'));
	}
} 
?>