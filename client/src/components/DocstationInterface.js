import React, { useState, useRef, useEffect } from 'react';
import parse from 'html-react-parser';

const DocstationInterface = ({ docs }) => {
  const [currentDoc, setCurrentDoc] = useState(docs[0]);
  const contentDiv = useRef(null);
  useEffect(() => {
    if (contentDiv.current) {
      contentDiv.current.scrollTop = 0;
    }
  }, [currentDoc]);
  return (
    <div className="docstation__wrap">
      <div className="docstation__doc" ref={contentDiv}>
        <div className="docstation__content">
          {parse(currentDoc.content)}
        </div>
      </div>
      <div className="docstation__nav">
        <h3>Table of contents</h3>
        <ul>
          {docs.map(doc => (
            <li className={currentDoc.id === doc.id ? 'current' : ''} key={doc.id}>
              <button
                title={doc.title}
                onClick={() => setCurrentDoc(doc)}
              >
                {doc.title}
              </button>
            </li>
          ))}
        </ul>
      </div>
    </div>
  );
};

export default DocstationInterface;
