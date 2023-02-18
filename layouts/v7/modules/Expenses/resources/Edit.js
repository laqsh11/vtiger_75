
Vtiger_Edit_Js("Expenses_Edit_Js", {},{
	
	copyAddressDetails : function(data,container,addressMap) {
		var self = this;
		var sourceModule = data['source_module'];
		var noAddress = true;
		var errorMsg;

		this.getRecordDetails(data).then(
			function(data){
				var response = data;
				
					for(var key in response.data) {
						container.find('[name="'+key+'"]').val(response.data[key]);
						container.find('[name="'+key+'"]').trigger('change');
					}
				
			},
			function(error, err){

			});
	},
	
	registerReferenceSelectionEvent : function(container) {
		var self = this;

		jQuery('input[name="releated_to"]', container).on(Vtiger_Edit_Js.referenceSelectionEvent, function(e, data){
			self.referenceSelectionEventHandler(data, container);
		});
	},
	
	
	referenceSelectionEventHandler : function(data,container){
		console.log(container);
		var self = this;
		if (data['selectedName']) {
			var message = app.vtranslate('OVERWRITE_EXISTING_MSG1')+app.vtranslate('SINGLE_'+data['source_module'])+' ('+data['selectedName']+') '+app.vtranslate('OVERWRITE_EXISTING_MSG2');
			app.helper.showConfirmationBox({'message' : message}).then(
			function(e) {
				self.copyAddressDetails(data, container);
			},
			function(error, err){
			});
		}
	},
	
	registerGenderSelectionEvent : function(container){
        
        jQuery('[name="gender"]',container).on('change',function(e){
            var gender = $(this).val();
            
            container.find('div[data-block="Male Info"]').addClass('hide');
            container.find('div[data-block="Female Info"]').addClass('hide');
            
            if(gender == "Male"){
                container.find('div[data-block="Male Info"]').removeClass('hide');
            } else if(gender == "Female"){
                container.find('div[data-block="Female Info"]').removeClass('hide');
            }
            
        })
    },
	
	showBlock : function(container) {
        var gender = jQuery('[name="gender"]',container).val();
        
        if(gender == "Male"){
            container.find('div[data-block="Female Info"]').addClass('hide');
        } else if(gender == "Female"){
            console.log(container.find('div[data-block="Male Info"]'));
            container.find('div[data-block="Male Info"]').addClass('hide');
        } else {
            container.find('div[data-block="Male Info"]').addClass('hide');
            container.find('div[data-block="Female Info"]').addClass('hide');
        }
    },

	registerBasicEvents: function(container){
        this._super(container);
        this.registerReferenceSelectionEvent(container);
        this.registerGenderSelectionEvent(container);
        this.showBlock(container);
    },
});