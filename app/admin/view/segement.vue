<template>
    <div class="py-3">
    	<div class="scrolling-wrapper" style="min-height: 250px;">
    		<div class="bg-light rounded p-2 mb-3">
    			<form class="form-inline">
    				<input type="text" placeholder="Search..." class="form-control form-control-xs mr-sm-2" v-model="keyword">
    				<div class="form-group">
    					<select class="form-control form-control-xs mr-3" v-model="type">
    						<option v-for="item in content.types" :value="item.value" :key="item.value"> {{ item.label }}</option>
    					</select>
    					<small id="segments-number" class="text-muted">
                        {{content.count}} items
                    	</small>
    				</div>
    			</form>
    			<ui class="intervals">
    				<li v-for="interval in content.intervals" :value="interval" :key="interval">{{interval}}</li>
    			</ui>
    			<div class="my-3" v-for="segment in segemts" :key="segment">
    				<small class="text-secondary pointer" :style="{marginLeft:segment.marginLeft+'%'}">
    					{{segment.label}}
    					<strong>{{segment.duration}}ms</strong>
    				</small>
    				<div class="progress pointer" :style="{width:segment.width+'%', marginLeft:segment.marginLeft+'%'}">
    					<div :class="['progress-bar', {'bg-warning':segment.bg == 'bg-warning', 'bg-danger': segment.bg == 'bg-danger'}]" style="width:100%"></div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</template>

<script>
    export default {
        props:{
            modelValue:String    //必须实现value参数
        },
        data(){
            return {
            	segemts: JSON.parse(this.modelValue).items,
                content: JSON.parse(this.modelValue),
                type:    '',
                keyword: '',
            }
        },
        watch:{
        	type(val){
        		console.log(val);
        		if(val == ''){
        			this.segemts = this.content.items;
        		}else{
        			var newItems = new Array();
        			for (var i = 0; i < this.content.items.length; i++) {
        				if(val == this.content.items[i]['type']){
        					newItems.push(this.content.items[i]);
        				}
        			}
        			this.segemts = newItems;
        		}
        	},
        	keyword(val){
        		console.log(val);
        		if(val == ''){
        			this.segemts = this.content.items;
        		}else{
        			var newItems = new Array();
        			for (var i = 0; i < this.content.items.length; i++) {
        				if(this.content.items[i]['label'].indexOf(val) != -1){
        					newItems.push(this.content.items[i]);
        				}
        			}
        			this.segemts = newItems;
        		}
        	},
            content(val){
                this.$emit('update:modelValue', val)  //回传组件
            }
        }
    }
</script>

<style scoped>
	body {
	    background-color: #f7f7f9;
	    font-family: Poppins,sans-serif;
	    font-size: .9rem;
	}
	body {
	    background-color: #fff;
	    color: #212529;
	    font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,Liberation Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;
	    font-size: 1rem;
	    font-weight: 400;
	    line-height: 1.5;
	    margin: 0;
	    text-align: left;
	}
	dl, ol, ul {
	    margin-top: 0;
	}
	li {
	    display: list-item;
	    text-align: -webkit-match-parent;
	}
	select {
	    word-wrap: normal;
	}
	b, strong {
	    font-weight: bolder;
	}
	button, input {
	    overflow: visible;
	}
	button, input, optgroup, select, textarea {
	    font-family: inherit;
	    font-size: inherit;
	    line-height: inherit;
	    margin: 0;
	}
	button, select {
	    text-transform: none;
	}
	button, input, optgroup, select, textarea {
	    font-family: inherit;
	    font-size: inherit;
	    line-height: inherit;
	    margin: 0;
	}
	.intervals li:not(:last-child) {
	    position: relative;
	}
	.intervals li {
	    flex: 1;
	    text-align: center;
	}
	.intervals li:not(:last-child):before {
	    border-right: 1px solid #f4f4f4;
	    content: "";
	    min-height: 250px;
	    position: absolute;
	    right: 0;
	    top: 0;
	}
	*, :after, :before {
	    box-sizing: border-box;
	}
	.header-subtitle, .list-group.side-menu .list-group-item.header, .text-muted {
	    color: #6c757d!important;
	}
	.p-2 {
	    padding: .5rem!important;
	}
	.mb-3, .my-3 {
	    margin-bottom: 1rem!important;
	}
	.pointer {
	    cursor: pointer;
	}
	.progress {
	    background-color: #e9ecef;
	    border-radius: .25rem;
	    font-size: .75rem;
	    height: 1rem;
	    line-height: 0;
	}
	.text-secondary {
	    color: #6c757d!important;
	}
	.form-inline {
	    align-items: center;
	    display: flex;
	    flex-flow: row wrap;
	}
	.rounded {
	    border-radius: .25rem!important;
	}
	.bg-light {
	    background-color: #f8f9fa!important;
	}
	.form-group {
	    margin-bottom: 1rem;
	}
	.form-inline .form-group, .form-inline label {
	    align-items: center;
	    display: flex;
	    margin-bottom: 0;
	}
	.form-inline .form-control {
	    display: inline-block;
	    vertical-align: middle;
	    width: auto;
	}
	.form-control-xs {
	    border-radius: .2rem;
	    font-size: .75rem!important;
	    height: calc(1.2em + .375rem + 2px)!important;
	    line-height: 1.5;
	    padding: .125rem .25rem!important;
	}
	.mr-3, .mx-3 {
	    margin-right: 1rem!important;
	}
	.form-control {
	    background-clip: padding-box;
	    background-color: #fff;
	    border: 1px solid #ced4da;
	    border-radius: .25rem;
	    color: #495057;
	    display: block;
	    font-size: 1rem;
	    font-weight: 400;
	    height: calc(1.5em + .75rem + 2px);
	    line-height: 1.5;
	    padding: .375rem .75rem;
	    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
	    width: 100%;
	}

	.bg-warning {
	    background-color: #ffa631!important;
	}
	.progress-bar {
	    background-color: #007bff;
	    color: #fff;
	    flex-direction: column;
	    justify-content: center;
	    text-align: center;
	    transition: width .6s ease;
	    white-space: nowrap;
	}
	.progress, .progress-bar {
	    display: flex;
	    overflow: hidden;
	}
	.scrolling-wrapper {
	    overflow-x: scroll;
	    overflow-y: hidden;
	    white-space: nowrap;
	}
	.pb-3, .py-3 {
	    padding-bottom: 1rem!important;
	}
	.intervals {
	    display: flex;
	    font-size: 14px;
	    font-weight: 700;
	    list-style: none;
	    margin-bottom: 20px;
	    position: relative;
	}
</style>