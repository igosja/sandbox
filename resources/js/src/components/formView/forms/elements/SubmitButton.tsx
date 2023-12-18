import React from 'react';

function SubmitButton() {
    return (
        <div className='row'>
            <div className='col-12 text-center'>
                <button type="submit" className='btn btn-default'>
                    Save
                </button>
            </div>
        </div>
    );
}

export default React.memo(SubmitButton);
