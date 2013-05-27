var BoilerAppUserControllerUserAccountIndex = {
	Extends: Controller,
	
	/**
	 * @var int : setTimeout id
	 */
	displayNameTimer : null,
	
	/**
	 * @return UserControllerUserAccount
	 */
	changeUserAvatar : function(){
		new Modal.Popup({
			'title':this.translate('change_avatar'),
			'url':this.url('User/Account/ChangeAvatar')
		});
		return this;
	},
	
	/**
	 * @param string sAvatar
	 * @return BoilerAppUserControllerUserAccountIndex
	 */
	setUserAvatar : function(sAvatar){
		var eUserAvatar = document.id('user_avatar');
		if(eUserAvatar == null)throw 'User avatar image is undefined';
		eUserAvatar.set('src','data:image/png;base64,'+sAvatar);
		return this;
	},
	
	/**
	 * @return BoilerAppUserControllerUserAccountIndex
	 */
	changeUserDisplayName : function(){
		new Modal.Popup({
			'title':this.translate('change_display_name'),
			'url':this.url('User/Account/ChangeDisplayName')
		});
		return this;
	},
	
	/**
	 * @param string sDisplayName
	 * @return BoilerAppUserControllerUserAccountIndex
	 */
	setUserDisplayName : function(sDisplayName){
		var eUserDisplayName = document.id('user_display_name');
		if(eUserDisplayName == null)throw 'User display name element is undefined';
		eUserDisplayName.set('html',sDisplayName);
		return this;
	},
	
	/**
	 * @param HTMLElement eDisplayName
	 * @return BoilerAppUserControllerUserAccountIndex
	 */
	checkDisplayNameAvailability : function(eDisplayName){
		eDisplayName = document.id(eDisplayName);
		if(eDisplayName == null)throw 'Display name input is undefined';
		
		//Remove timer
		this.displayNameTimer = null;
		var oValidator = eDisplayName.getParent('form').get('validator'), sDisplayName = eDisplayName.get('value');
		if(!sDisplayName.length || !oValidator.test('validate-nospace',eDisplayName))return this;
		
		this.displayNameTimer = setTimeout(function(){
			//Set input is loading
			eDisplayName.setLoading();
			new Request.JSON({
				'url':this.url('User/Account/CheckDisplayNameAvailability'),
				'data':{'display_name':sDisplayName},
				'onSuccess':function(oResponse){
					var bAvailable = oResponse.available === true;
					//Display user display name availability checked
					if(!bAvailable)eDisplayName.removeClass('validation-passed');
					eDisplayName.store('display-name-available',oResponse.available).setLoading('icon-'+(bAvailable?'ok':'ban-circle')).fireEvent('change');
				}.bind(this)
			}).send();
			this.nameTimer = null;
		}.bind(this),250);
		return this;
	}
};
BoilerAppUserControllerUserAccountIndex = new Class(BoilerAppUserControllerUserAccountIndex);