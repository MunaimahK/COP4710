class NarbarComponent extends HTMLElement {
    constructor() {
      super();
    }

    connectedCallback() {
      this.innerHTML = `
        <div class="nav">
          <nav>
            <ul>
              <div class="nav">
                <a href="/ship-registration.html">Ship Registration </a>
                <a href="#">Port Entry </a>
                <a href="#">Port Exit </a>
                <a href="#">Crane Operator</a>
                <a href="#">Truck Registration</a>
                <a href="#">Truck Driver Registration</a>
                <a href="#">Container Company Registration</a>
                <a href="#">Port Admin Management</a>
              </div>
          </nav>
        </div>
      `;
    }
  }

  customElements.define('navbar-component', NarbarComponent);