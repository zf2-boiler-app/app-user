Form.Validator.addAllThese([
	['displayNameIsAvailable',{
		'errorMsg': function(eElement){
			return eElement.retrieve('display-name-available');
		},
		'test': function(eElement){
			return eElement.retrieve('display-name-available',true) === true;
		}
	}]
]);