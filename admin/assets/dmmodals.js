class Modal {
    /**
     * Contains a reference to the button element object
     */
    btn = null;
    
    /**
     *  Contains a reference to the modal element object 
    */
    modal = null;

    /**
     * Current modal name
     */
    modalName = '';

    listenersOpenModal = [];

    listenersCloseModal = [];

    constructor (btn, modal) {
        this.btn = btn;
        this.modal = modal;
    }

    resurrect = () => {
        this
            .initModalName()
            .handlerInitialization();

        return this;
    }

    handlerInitialization = () => {
        this.btn.addEventListener('click', this.handlerOpenModal);

        this.modal.querySelector('.close-modal').addEventListener('click', this.handlerCloseModal);
    }

    handlerOpenModal = () => {
        this.modal.classList.add('show');

        this.runFunctions(this.listenersOpenModal);
    }

    handlerCloseModal = () => {
        this.modal.classList.remove('show');

        this.runFunctions(this.listenersCloseModal);
    }

    runFunctions = (functions = []) => {
        for (let i = 0; i < functions.length; i++) {
            if (functions[i] && {}.toString.call(functions[i]) === '[object Function]') {
                functions[i](this);
            }
        }
    }

    initModalName = () => {
        this.modalName = this.modal.getAttribute('data-modal-title');

        return this;
    }

    getModal = () => {
        return this.modal;
    }

    getBtn = () => {
        return this.btn;
    }

    /**
     * 
     * @param {string} type - Indicates the event type, supported event types: close | open
     * @param {Function} callback - Function that fires on an event
     */
    addEventListener = (type = '', callback = () => {}) => {
        switch (type) {
            case 'close':
                this.listenersCloseModal.push(callback);
                break;
            case 'open':
                this.listenersOpenModal.push(callback);
                break;
            default:
                break;
        }

        return this;
    }
}


class MDModal {
    /**
     * Contains all modals on the page
     */
    modals = [];

    /**
     * Is the global storage for active modals
     */
    modalContainer = null;

    /**
     * Contains a reference to the overlay object
     */
    overlay = null;

    wrapper = null;
    
    SELECTOR_BTN = '.btn[data-modal-type="btn"]';

    DATA_ATTR_MODAL_NAME = 'data-modal-name';

    isActiveModal = false;

    activeModals = [];

    header = null;

    constructor () {
        this
            .searchModals()
            .createOverlay()
            .createWrapper()
            .createHeader()
            .insertContentToWrapper();
    }

    searchModals = () => {
        const foundBtnsModals = document.querySelectorAll(this.SELECTOR_BTN);
        console.log(this);

        for (let i = 0; i < foundBtnsModals.length; i++) {
            const btn = foundBtnsModals[i];
            const hideModalName = btn.getAttribute(this.DATA_ATTR_MODAL_NAME);
            const modalEL = document.querySelector(`.md-modal[data-modal-name=${hideModalName}]`);

            if (!modalEL) {
                throw new Error('No modal found!');
            }

            const modal = new Modal(btn, modalEL);

            modal.resurrect()
                .addEventListener('open', this.onOpenModal)
                .addEventListener('close', this.onCloseModal)

            this.modals.push(modal);
        }

        return this;
    }

    onOpenModal = (modal) => {
        this.showWrapper();
        this.activeModals.push(modal);
        this.updateHeaderModal();
    }

    onCloseModal = (modal) => {
        this.activeModals = this.activeModals.filter(md => md !== modal);

        this.hideWrapper();
        this.updateHeaderModal();
    }

    createOverlay = () => {
        const overlay = document.createElement('div');
        overlay.classList.add('md-modal-overlay');
        this.overlay = overlay;

        return this;
    }

    createWrapper = () => {
        const wrapper = document.createElement('div');
        wrapper.classList.add('md-modal-wrapper');

        document.querySelector('body').appendChild(wrapper);

        this.wrapper = wrapper;

        return this;
    }

    createHeader = () => {
        const header = document.createElement('div');
        header.classList.add('md-modal-header');

        this.header = header;

        return this;
    }

    insertContentToWrapper = () => {
        this.wrapper.appendChild(this.header);
        this.wrapper.appendChild(this.overlay);

        for (let i = 0; i < this.modals.length; i++) {
            this.wrapper.appendChild(this.modals[i].getModal());
        }

        return this;
    }

    updateHeaderModal = () => {
        this.checkShowHeader();

        
    }

    checkShowHeader = () => {
        if (this.activeModals.length >= 2) {
            this.activeModals.classList.add('show');
        } else {
            this.activeModals.classList.remove('show');
        }
    }

    addItemHeader = () => {

    }

    removeItemHeader = () => {
        
    }

    showWrapper = () => {
        if (!this.isActiveModal) {
            this.wrapper.classList.add('show');
            this.isActiveModal = true;
        }
    }

    hideWrapper = () => {
        if (this.isActiveModal && this.activeModals.length === 0) {
            this.wrapper.classList.remove('show');
            this.isActiveModal = false;
        }
    }
}

window.addEventListener("load", function(){
    document.dmmodal = new MDModal;
});