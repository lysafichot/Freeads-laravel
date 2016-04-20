var dom = {
	input: document.getElementsByTagName("input"),

	init: function() {
		this.input_style();
	},
	input_style: function() {
		self = this;
		for (var i = 0; i < this.input.length; i++) {

			this.input[i].onfocus = function() {
				self = this;
				var label = this.previousElementSibling;
				if(label) {
					label.style.transition = 'transform 1.0s ease-in-out 0s';
					label.style.transform = 'scale(0.5) translate(-70px, -40px)';
				}
			}
			this.input[i].onblur = function() {
				if(this.value == "") {
					var label = this.previousElementSibling;
					if(label) {
						label.style.transition = 'transform 1.0s ease-in-out 0s';
						label.style.transform = 'scale(1) translate(0px, 4px)';
					}
				}

			}

		}
	}
}

dom.init();
